<?php
include_once 'secure_controller.php';
include '../library/OpenInviter/openinviter.php';
include '../model/Contact.class.php';
include '../service/ContactService.class.php';

// Taking form data
$email 	 	  = trim($_POST["emailText"]);
$password  	  = trim($_POST["passwordEmailText"]);
$emailClient  = trim($_POST["emailClientText"]);

// Validations
$valid = 0;
$valid += isRequired(array($email, $password, $emailClient));
$valid += isMax(array($emailClient => MAX_NOMBRE, $email => MAX_MAIL));
$valid += isEmail($email);
if ($emailClient != "gmail" && $emailClient != "hotmail") {
	$valid++;	
}
if ($valid > 0) {
	print encodeResponse(false, "Los campos usuario, password y el tipo de cliente de mail son obligatorios. No olvides completar dichos campos. Gracias!");
	die();
}	
	
// Gets email contacts
$contactService = new ContactService();
$contacts = $contactService->getContacts($email, $password, $emailClient);

if ($contacts == null){
	print encodeResponse(false, "El usuario y/o password ingresado no es correcto. Por favor verifica estos campos.");
	die();
}

$json = new Services_JSON;
print $json->encode($contacts);
die();





