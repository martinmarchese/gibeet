<?php
include_once 'secure_controller.php';
include '../library/OpenInviter/openinviter.php';
include '../model/Contact.class.php';
include '../service/ContactService.class.php';

// Taking form data
$ids = $_POST["ids"];

// Converts into contact objects
for ($i=0; $i<count($ids); $i++) {
	$c = new Contact();
	$c->idUser = $loggedUser->idUser;
	$c->id = trim($ids[$i]);
	$contactList[$i] = $c;
}

$contactService = new ContactService();
$contactService->deleteContacts($contactList, $loggedUser->idUser);

print encodeResponse(true, "Los contactos se han eliminado correctamente!");
die();
?>