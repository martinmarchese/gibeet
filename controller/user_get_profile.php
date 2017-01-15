<?php 
include_once 'secure_controller.php';

$userService = new UserService();
$user = $userService->get($loggedUser->idUser);

// Convert birth into APP date format
$b = split("-", $user->birth);
$user->birth = $b[2]."/".$b[1]."/".$b[0];

$user->password = "";
if ($user == null) {
	print encodeResponse(false, "Hemos tenido un inconveniente al obtener tu informaci&oaucte;n, por favor recarga la p&aacute;gina para ver tu perfil correctamente!. Gracias.");
	die();
}

print encodeObjectResponse(true, "", $user);
die();
?>