<?php
include_once 'secure_controller.php';
include '../library/OpenInviter/openinviter.php';
include '../model/Contact.class.php';
include '../service/ContactService.class.php';

// Taking form data
$contacts = $_POST["contacts"];
	

// Converts into contact objects
for ($i=0; $i<count($contacts); $i++) {
	$data = explode('|', $contacts[$i]);
	$c = new Contact();
	$c->idUser = $loggedUser->idUser;
	$c->name = trim($data[1]);
	$c->email = trim($data[0]);
	$contactList[$i] = $c;
}
	
// Save contacts
$contactService = new ContactService();
$contactService->saveContacts($contactList, $loggedUser->idUser);

print encodeResponse(true, "Los contactos se han almacenado correctamente!");
die();

?>