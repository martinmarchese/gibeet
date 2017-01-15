<?php
include_once 'secure_controller.php';

// Registration values
$name 	 = trim($_POST["name"]);
$email 	 = trim($_POST["mail"]);
$position = trim($_POST["position"]);
$birth   = trim($_POST["birth"]);
$country = trim($_POST["country"]);
$city = trim($_POST["city"]);

// Validations
$valid = 0;
$valid += isRequired(array($name, $email));
$valid += isMax(array($name => MAX_NOMBRE, $position => MAX_PUESTO, $email => MAX_MAIL, $birth => MAX_BIRTH, $country => MAX_COUNTRY, $city => MAX_CITY));
$valid += isAlphanumeric(array($name, $country, $city));
$valid += isEmail($email);
$valid += isDate($birth);

if ($valid > 0) {
	print encodeResponse(false, "Atenti!, verifica los campos ingresados. No olvides que todos son obligatorios y solo pueden contener n&uacute;meros y letras.");
	die();
}

// Convert birth into DB date format
$b = split("/", $birth);
$birth = $b[2]."-".$b[1]."-".$b[0];


// Create user object
$userService = new UserService();
$user = new User();
$loggedUser->name = $name;
$loggedUser->email = $email;
$loggedUser->position = $position;
$loggedUser->birth = $birth;
$loggedUser->country = $country;
$loggedUser->city = $city;

$userService = new UserService();
$res = $userService->updateProfile($loggedUser);

if ($res) {
	print encodeResponse(true, "Has actualizado satisfactoriamente la informaci&oacute;n de perfil!");
	die();
}

print encodeResponse(false, "Disculpa!, hemos tenido un inconveniente al guardar tu informaci&oacute;n de perfil. Por favor intenta de nuevo!");
die();



?>