<?php
include 'controller.php';
include '../model/User.class.php';
include '../service/UserService.class.php';

$code = $_POST["code"];
$password  = trim($_POST["password"]);
$password2 = trim($_POST["password2"]);

// Validations
$valid = 0;
$valid += isRequired(array($code, $password, $password2));
$valid += isMax(array($password => MAX_PASSWORD, $password2 => MAX_PASSWORD));
$valid += isAlphanumeric(array($password, $password2));
$valid += isEqual($password, $password2);

if ($valid > 0) {
	print encodeResponse(false, "Atenti!, verifica los campos ingresados. No olvides que todos son obligatorios y solo pueden contener n&uacute;meros y letras.");
	die();
}
	
// Verify code and timestamp
$userService = new UserService();
$userVerified = $userService->verifyTSandCode($code);
	
if ($userVerified == null){
	print encodeResponse(false, "No es posible actualizar tu contrase&ntilde;a. Por favor intenta m&aacute;s tarde o cont&aacute;ctate con nuestro equipo para solicitar ayuda.");
	die();
}
	
// Setting new password
$passwordHash = $userService->getPasswordHash($password);
$userVerified->password = $password;
$res = $userService->updatePassword($userVerified->idUser, $passwordHash);

if ($res == null){

	$msg = "No es posible actualizar tu contrase&ntilde;a. Por favor intenta mas tarde o cont&aacute;ctate con nuestro equipo para recibir ayuda."; 
	print encodeResponse(false, $msg);
	die();
	
} else {
	// User login
	$userService->authenticate($userVerified);
	
	$msg = "Actualizamos tu contrase&ntilde;a correctamente! Bienvenido a Gibeet.com nuevamente!";
	$_SESSION["NOTIFICATION"] = $msg;
	print encodeResponse(true, $msg);
	die();	
}

?>