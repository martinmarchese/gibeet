<?php
include_once 'secure_controller.php';
include_once '../model/Contact.class.php';
include_once '../model/Entity.class.php';
include_once '../service/ContactService.class.php';
include_once '../service/EmailService.class.php';
include_once '../service/UserService.class.php';

$contactService = new ContactService();
$contacts = $contactService->getUserContacts($loggedUser->idUser);

if (!$contacts) {
	print encodeResponse(false, "No tienes contactos para compartir tu acci&oacute;n RSE. Ve a la opci&oacute;n de tu panel y agrega algunos!");
	die();
}

$userService = new UserService();
$entity = $userService->getFriendEntity($loggedUser);

// Email params
$params["user"] = $loggedUser->username;
$params["entidadUsername"] = $entity->username;
$params["entidadName"] = $entity->name;
$params["link"] = "http://www.gibeet.com.ar/index.php?sk=".$entity->username."&empresa=".$loggedUser->username;

$emailService = new EmailService();
$emailService->sendHTMLEmails("../notification/ShareEntity.php", "difusion@gibeet.com.ar", $contacts, $loggedUser->username . " quiere que participes de su accion RSE", $params);

print encodeResponse(true, "Has difundido exitosamente tu acci&oacute;n RSE!");
die();
?>
