<?php
include_once 'secure_controller.php';
include_once '../model/User.class.php';
include_once '../model/Entity.class.php';
include_once '../service/UserService.class.php';

$entity = trim(strtolower($_POST["username"]));

// Validations
$valid = 0;
$valid += isRequired(array($entity));

if ($valid > 0) {
	print encodeResponse(false, "Hubo un error al procesar tu informaci&oacute;n. Por favor, recarga la p&aacute;gina y vuelve a intentar.");
	die();
}


$userService = new UserService();
$res = $userService->addFriendEntity($loggedUser, $entity);

if ($res) {
	$_SESSION["NOTIFICATION"] = "Has agregado correctamente la entidad. A partir de ahora podr&aacute;s realizar junto a ella, tus acciones RSE!";
	print encodeResponse(true, $_SESSION["NOTIFICATION"]);
	die();
}

print encodeResponse(false, "Hubo un error al procesar tu informaci&oacute;n. Por favor, recarga la p&aacute;gina y vuelve a intentar.");
die();
?>