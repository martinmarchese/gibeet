<?php 
include_once 'secure_controller.php';

$path = "../images/profiles/";

$valid_formats = array("jpg", "png", "gif","jpeg");
$name = $_FILES['profileImage']['name'];
$size = $_FILES['profileImage']['size'];

// POST validation
if(!isset($_POST) || $_SERVER['REQUEST_METHOD'] != "POST") {
	print encodeResponse(false, "Disculpa!, hemos tenido un inconveniente al guardar tu imagen de perfil. Por favor intenta de nuevo!");
	die();
}

// Name validation
if(!strlen($name)) {
	print encodeResponse(false, "Disculpa!, hemos tenido un inconveniente al guardar tu imagen de perfil. Por favor intenta de nuevo!");
	die();
}


list($txt, $ext) = explode(".", $name);
$ext = strtolower($ext);

// Extension validation
if(!in_array($ext, $valid_formats)) {
	print encodeResponse(false, "Solo permitimos im&aacute;genes con extensiones JPG, PNG o GIF. Gracias!");
	die();
}

// Size validation
if($size > (1021*1024*3)) {
	print encodeResponse(false, "La imagen que intentas subir es demasiado grande. Por favor, intenta con una m&aacute;s peque&ntilde;a");
	die();
}

$actual_image_name = time().$session_id.".".$ext;
$tmp = $_FILES['profileImage']['tmp_name'];
if(move_uploaded_file($tmp, $path.$actual_image_name)) {

	//mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
	//echo "<img src='uploads/".$actual_image_name."' class='preview'>";

	$userService = new UserService();
	$userService->saveImage($actual_image_name, $loggedUser->idUser);

	print encodeResponse(true, $actual_image_name);
	
} else {
	print encodeResponse(false, "Disculpa!, hemos tenido un inconveniente al guardar tu imagen de perfil. Por favor intenta de nuevo!");
}

die();
?>