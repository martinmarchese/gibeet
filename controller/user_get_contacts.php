<?php
include_once 'secure_controller.php';
include '../library/OpenInviter/openinviter.php';
include '../model/Contact.class.php';
include '../service/ContactService.class.php';

// Save contacts
$contactService = new ContactService();
$contacts = $contactService->getUserContacts($loggedUser->idUser);

print encodeObjectResponse(true, "", $contacts);
die()
?>