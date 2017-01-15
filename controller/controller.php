<?php
session_start();
include_once '../config/constants.php';
include_once '../library/InputFilter.class.php';
include_once '../library/JSON.php';
include_once '../library/Validations.php';
include_once '../service/Database.class.php';

// Clean form POSTs from XSS
$inputFilter = new InputFilter();
$_POST = $inputFilter->process($_POST);

// JSON
function encodeResponse($success, $msg) {
	$json = new Services_JSON;
	return $json->encode(array("success" => $success, 
			   				   "msg" => $msg));
}

function encodeObjectResponse($success, $msg, $obj) {
	$json = new Services_JSON();
	return $json->encode(array("success" => $success, 
			   				   "msg" => $msg,
							   "obj" => $obj));
}
?>