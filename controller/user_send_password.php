<?php
include 'controller.php';
include '../model/User.class.php';
include '../service/UserService.class.php';
include '../service/EmailService.class.php';

$username = trim($_POST["usuario"]);
	
// Verifies if user exists
$userService = new UserService();
$usernameResponse = $userService->getByUsername($username);
	
if ($usernameResponse == null){
	print encodeResponse(false, "El usuario que has ingresado no pertenece a un usuario registrado!");
	die();
}
	
// Makes random code
$code = md5( mt_rand().$username.time());
$userService->setTSandCode($username,$code);
		
// Send email with forgot password steps
$emailContent  = "Haz perdido tu contraseña.";
$emailContent .= "<br/><br/>";
$emailContent .= "Para recuperarla ingresá al siguiente link y seguí los pasos allí indicados: ";
$emailContent .= "<a href=\"";
$emailContent .= HOST."/index.php?sk=retrievepassword&code=".$code;
$emailContent .= "\">";
$emailContent .= HOST."/index.php?sk=retrievepassword&code=".$code."</a>";
$emailContent .= "<br/><br/><br/><br/>";
$emailContent .= "Te saluda cordialmente, el equipo de Gibeet.com";
	
$emailService = new EmailService();
$res = $emailService->sendTextEmail($emailContent, "recupero@gibeet.com.ar", $usernameResponse->email, "Link confirmación recupero de contraseña", $params);

if ($res){
	print encodeResponse(true, "Se ha enviado a tu casilla de correo electr&oacute;nico el link para recuperar tu contrase&ntilde;a");
}else{
	print encodeResponse(false, "No hemos podido enviarte los pasos para recuperar tu contrase&ntilde;a, por favor intenta nuevamente.");
}

die();
