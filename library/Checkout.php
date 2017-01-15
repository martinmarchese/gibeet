<?php
/**
 *  Configuracion de servicios de MercadoPago
 */
include_once '../config/constants.php';
include_once '../library/JSON.php';
include_once '../model/EntityCheckout.class.php';
include_once '../service/CheckoutService.class.php';

$url_authenticate = "https://api.mercadolibre.com/oauth/token";


function send($url, $params, $content_type) {

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


function aunthenticate() {
	global $url_authenticate;
	
	$params = "client_id=" . MP_CLIENT_ID . "&" .
			  "client_secret=" . MP_CLIENT_SECRET . "&" .
			  "grant_type=client_credentials"; 

	$res = send($url_authenticate, $params, "application/x-www-form-urlencoded");
	
	if (!$res) { 
		echo "aunthenticate(): Error al obtener access_token Mercadopago <br>";
		die();
	} else {
		
		$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		$res = $json->decode($res);
		$token = $res["access_token"];
		
		if ($token == "" || !$token) {
			echo "aunthenticate(): El access_token no tiene un valor valido <br>";
			die();
		} else {
			return $token;
		}
	}
}

/**
 * Configura las preferencias de pago para la entidad especificada
 * @param  $token access_token
 * @param  $username   username de la ong a configurar sus preferencias de pago
 * 					   Este campo sera de utilidad para despues realizar la query sobre el total de pagos (numero que se muestra en el timeline como 
 * 					   dinero recaudado. Tiene que ser unico!!!!
 */
function configure($token, $username) {
	
	$url = "https://api.mercadolibre.com/checkout/preferences?access_token=" . $token;
	$money = array("5","10","20","50","100");
	
	foreach ($money as $m) {
		
		$params = "{\"items\":[{\"id\":\"$username\",\"title\":\"$username\",\"quantity\":1,\"unit_price\": $m, \"picture_url\":\"http://www.gibeet.com.ar/images/logo.png\" , \"currency_id\":\"ARS\"}]}";

		$res = send($url, $params, "application/json");
		
		echo "<br>";
		if (!$res) {
			echo "configure() Hubo un error al configurar las preferencias de pago de: ". $username. " se aborto la operacion! <br>";
			die();
		}
		$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		$res = $json->decode($res);
		echo "    -> guardando en DB pref_id = " . $res["id"] . "<br>";
		
		$checkout = new EntityCheckout();
		$checkout->username = $username;
		$checkout->pref_id = $res["id"];
		$checkout->money = $m;
		
		$checkoutService = new CheckoutService();
		$db_res = $checkoutService->save($checkout);
		if (!$db_res) { 
			echo "configure() Hubo un error al guardar pref_id en DB. Abortando la operacion! <br>";
			die(); 
		}
		echo "    -> guardado en DB ok <br>";
		echo "## Se configuro correctamente " . $username. " con $ $m -<br><br>";
	}
}




// Main()
echo " ###### Obteniendo access_token ...<br>";
$token = aunthenticate();
echo " ###### Se ha obtenido correctamente el access_token <br><br>";

echo " ###### Iniciando configuracion ...<br>";
configure($token, "abrirlapuerta");
echo " ###### La configuarion ha terminado."
?>