<?php
// Config
include_once '../config/constants.php';

// Service objects
include_once '../service/Database.class.php';

// Library objects
include_once '../library/JSON.php';
include_once '../library/InputFilter.class.php';

$json = new Services_JSON;
$ifilter = new InputFilter();

/**
 *  Adds a prospect
 */
$_POST = $ifilter->process($_POST);

$email = trim($_POST["email"]);
$ts = trim($_POST["ts"]);
$currentTs = time();
	 
if ($ts == '' ) {
    header('HTTP/1.1 500');
	print $json->encode(array("success"=>false, "msg" => "No haz ingresado tu correo electronico desde Gibeet.com, para subscribirte debes ingresar a www.gibeet.com")); '';
	die();
}

if ($email == "" || !preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
	header('HTTP/1.1 500');
	print $json->encode(array("success"=>false, "msg"=>"Oops! El mail ingresado no tiene un formato correcto. Por favor verifica que el formato sea como el siguiente: tu_nombre@dominio.com. Muchas gracias!")); '';
	die();
}

$db = Database::getInstance();
$sql  = " INSERT INTO prospect (creation_date, email)"; 
$sql .=	"      VALUES ('".date("y-m-d")."',";
$sql .= "'".mysql_escape_string($email)."')";
$db->setQuery($sql);
$status = $db->execute();

if ($status != null) {
	print $json->encode(array("success"=>true, "msg"=>"Muchas gracias por interesarte en Gibeet! Proximamente te haremos llegar noticias sobre el avance del proyecto!")); '';
	die();
	
} else {
	print $json->encode(array("success"=>false, "msg"=>"Tuvimos un inconveniente al guardar tu informacion. Por favor intenta de nuevo. Muchas gracias!")); '';
	die();	
}

?>