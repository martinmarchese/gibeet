<?php
session_start();
include_once 'controller.php';
include_once '../model/User.class.php';
include_once '../service/UserService.class.php';

if (UserService::verifyCookie()) {
	
	list($id, $expiration, $hmac) = explode('|', $_COOKIE[COOKIE_AUTH]);
	
	$userService = new UserService();
	$loggedUser = $userService->get($id);
} else {
	
	print encodeResponse(false, "<a href='login'><b> Tu sesi&oacute;n a expirado. Por favor, haz click aqu&iacute; para ingresar nuevamente. Gracias!! </b></a>");
	die();
}