<?php
include_once 'Database.class.php';

class CheckoutService {
	
	public $url_authenticate = "https://api.mercadolibre.com/oauth/token";
	
	public $url_search = "https://api.mercadolibre.com/collections/search";
	
	public function save($checkout) {
		
		$db = Database::getInstance();
		$sql  = "INSERT INTO checkout_pref ";
		$sql .= " (creation_date, username, pref_id, money) "; 
		$sql .= " VALUES ('".date(DATE_DB_FORMAT)."','".$checkout->username."','".$checkout->pref_id."', '".$checkout->money."')";
		$db->setQuery($sql);
		echo $sql;
		return $db->execute();
	}
	
	public function getByUsername($username) {
		
		$checkout = new EntityCheckout();
		$db = Database::getInstance();
		$sql  = "SELECT * FROM checkout_pref ";
		$sql .= " WHERE username = '".$username."'";
		$sql .= " ORDER BY id DESC, money ASC";
		$sql .= " LIMIT 0,5";
		$db->setQuery($sql);
		return $db->loadObjectList(get_class($checkout));
	}
	
	public function getMoneyAndCollaboratorsByUsername($username) {
		
		$token = $this->authenticate();
		if ($token) {
			$params = "access_token=".$token."&status=approved&reason=".$username;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded","Accept:application/json")); 
 			curl_setopt($ch, CURLOPT_URL, $this->url_search."?".$params);
 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 		
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
 			$response = curl_exec($ch);
 			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
 			curl_close($ch);

 			if ($httpCode != 200 && $httpCode != 201) {
 				return false;
 			} else {
 				$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
				$res = $json->decode($response);
				
				//echo $response;
				
				$collections = $res["results"];
				$total = 0;
				for ($i=0; $i<count($collections); $i++) {
					$c = $collections[$i]["collection"];
					$total += $c["total_paid_amount"];
					$collaborators .= $c["external_reference"]."|";
				}
				return $total.",".$collaborators;
 			}
		}
		
	}
	
	public function send($url, $params, $content_type) {
	
		// Open connection
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: ".$content_type,"Accept:application/json")); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	 		
		// POST call
	   	$response = curl_exec($ch);
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	
		curl_close($ch);
	
		if (!$response) {
			return false;
		}
		
		//echo $httpCode;
		if ($httpCode != 200 && $httpCode != 201) {
			return false;
		} else {
			return $response;
		}
	}
	
	public function authenticate() {
	
		$params = "client_id=" . MP_CLIENT_ID . "&" .
				  "client_secret=" . MP_CLIENT_SECRET . "&" .
				  "grant_type=client_credentials"; 

		$res = $this->send($this->url_authenticate, $params, "application/x-www-form-urlencoded");
	
		if (!$res) { 
			return false;
		} else {
			$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
			$res = $json->decode($res);
			$token = $res["access_token"];
		
			if ($token == "" || !$token) {
				return false;
			} else {
				return $token;
			}
		}
	}
	
}
?>