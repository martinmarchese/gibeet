<?php

class EmailService {


	private $HTML = "";
	
	private function getHTML($filename, $params) {
		
		if ($this->HTML == "") {
			$file = fopen($filename, "r") or exit("Unable to open file!");
			$this->HTML = "";
			while (!feof($file)) { 
				
				$read = fgets($file);
				
				if (count($params)>0 && $params != null){
					foreach ($params as $p => $v){
						$read = str_ireplace("@@@".$p."@@@", $v, $read);
					}
				}
				$this->HTML .= $read;	 
			}
			fclose($file);
		}
	}
	
	/**
	 * Send a HTML Email
	 */
	public function sendHTMLEmail($filename, $from, $to, $subject, $params) {	

		// Get HTML content
		$this->getHTML($filename, $params);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html;charset=UTF-8' . "\r\n"; 
    	$headers .= "From: $from \r\n\Reply-To: $from"; 

    	if (mail($to,$subject,$this->HTML,$headers)){
	    	return true;
	    }else{
    		return false;
    	} 
	}
	
	/**
	 * Send a HTML to a list of mails
	 */
	public function sendHTMLEmails($filename, $from, $toList, $subject, $params) {

		for ($i=0; $i<count($toList); $i++) {
			$this->sendHTMLEmail($filename, $from, $toList[$i]->email, $subject, $params);
			sleep(1);
		}
	}
	
	/**
	 * Send a Text Email
	 */
	public function sendTextEmail($text, $from, $to, $subject){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html;charset=UTF-8' . "\r\n"; 
    	$headers .= "From: $from \r\n\Reply-To: $from"; 

    	if (@mail($to,$subject,$text,$headers)){
	    	return true;
	    }else{
    		return false;
    	} 
	}

}

?>