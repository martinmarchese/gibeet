<?php
include 'controller.php';
include '../model/User.class.php';
include '../service/UserService.class.php';

// Form data
$username = trim($_POST["usuario"]);
$password = trim($_POST["password"]);

// User
$user = new User();
$user->username = $username;
$user->password = $password;


// Brute force protection
if ($_SESSION["MAX_LOGIN_ATTEMPS"] > MAX_LOGIN_ATTEMPS && $_SESSION["LOGIN_BLOCK_EXPIRE_OFFSET"] > time()) { 
	
	$_SESSION["LOGIN_BLOCK_EXPIRE_OFFSET"] = time() + LOGIN_BLOCK_EXPIRE_OFFSET;
	print encodeResponse(false, ":[ Detectamos desde tu computadora, muchos intentos fallidos de ingreso. Por tu seguridad bloqueamos el ingreso y almacenamos tu IP. Por favor intenta nuevamente en " . LOGIN_BLOCK_EXPIRE_OFFSET / 60 . " minutos. Gracias!");	
	die();
} else {
	 $_SESSION["LOGIN_BLOCK_EXPIRE_OFFSET"] = 0; 
}


try {
	// Authentication
	$userService = new UserService();
	$user = $userService->authenticate($user);
	
	$_SESSION["MAX_LOGIN_ATTEMPS"] = 0;
	$_SESSION["LOGIN_BLOCK_EXPIRE_OFFSET"] = 0;
	$_SESSION["NOTIFICATION"] = "Bienvenido, ".$user->name." !!!";
	print encodeResponse(true, "");
	die();
} catch (Exception $e) {
	
	$_SESSION["MAX_LOGIN_ATTEMPS"]++;
	$_SESSION["LOGIN_BLOCK_EXPIRE_OFFSET"] = time() + LOGIN_BLOCK_EXPIRE_OFFSET;
	print encodeResponse(false, "El usuario o contrase&ntilde;a ingresados no son correctos. Por favor, verif&iacute;calos.");
	die();
}

?>