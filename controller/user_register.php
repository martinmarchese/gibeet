<?php
include 'controller.php';
include '../model/User.class.php';
include '../service/UserService.class.php';

// Registration values
$usuario = trim($_POST["usuario"]);
$nombre  = trim($_POST["nombre"]);
$puesto  = trim($_POST["puesto"]);
$email 	 = trim($_POST["mail"]);
$password  = trim($_POST["password"]);
$password2 = trim($_POST["password2"]);

// Validations
$valid = 0;
$valid += isRequired(array($usuario, $nombre, $puesto, $email, $password, $password2));
$valid += isMax(array($usuario => MAX_USUARIO, $puesto => MAX_PUESTO, $nombre => MAX_NOMBRE, $email => MAX_MAIL, $password => MAX_PASSWORD, $password2 => MAX_PASSWORD));
$valid += isAlphanumeric(array($usuario, $nombre, $puesto, $password, $password2));
$valid += isEmail($email);
$valid += isEqual($password, $password2);

if ($valid > 0) {
	print encodeResponse(false, "Atenti!, verifica los campos ingresados. No olvides que todos son obligatorios y solo pueden contener n&uacute;meros y letras.");
	die();
}

// Create user object
$userService = new UserService();
$user = new User();
$user->username = $usuario;
$user->email = $email;
$user->name = $nombre;
$user->position = $puesto;
$user->password = $password;


// If user exists
$exists = $userService->exists($user);
if ($exists) {
	print encodeResponse(false, "Parece que ya hay un usuario registrado con ese nombre de usuario o mail. Prueba con uno diferente, Gracias!.");
	die();
}

// One time token validation
validateToken($_POST["token"]);

// Register
$res = $userService->register($user);
if ($res) {
	$userService->authenticate($user);
	$_SESSION["NOTIFICATION"] = "Gracias por registrarte!, Ya sos parte de la comunidad de Gibeet.com!";
	print encodeResponse(true, "");
	die();
} 

print encodeResponse(false, "Parece que hubo un inconveniente al procesar tus datos. Por favor, recarga la p&aacute;gina y vuelve a intentar. Gracias! (Puedes hacerlo presionando la tecla F5)");
die();

?>
