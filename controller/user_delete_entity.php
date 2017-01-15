<?php
include_once 'secure_controller.php';
include_once '../model/User.class.php';
include_once '../model/Entity.class.php';
include_once '../service/UserService.class.php';

$userService = new UserService();
$userService->deleteFriendEntity($loggedUser);

$_SESSION["NOTIFICATION"] = "Has terminado tu acci&oacute;n RSE con la entidad. Puedes buscar otra y nuevas acciones RSE !";
print encodeResponse(true, $_SESSION["NOTIFICATION"]);
die();
?>