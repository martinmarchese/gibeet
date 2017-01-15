<?php
/**
 * One time token validation
 */
function validateToken($token) {

	if ($token != $_SESSION["one-time-token"]) {
		print encodeResponse(false, "Parece que hubo un inconveniente al procesar tus datos. Por favor, recarga la p&aacute;gina y vuelve a intentar. Gracias! (Puedes hacerlo presionando la tecla F5)");
		die();
	}
	$_SESSION["one-time-token"] = null;
}


function obj2Array($value) {
	if (count($value)==1) {
		return array($value);
	}
	return $value;
}
function isRequired($values) {

	$values = obj2Array($values);
	for ($i=0; $i<count($values); $i++) {
		$value = $values[$i];
		if ($value == null || $value == "") {
			return 1;
		}
	}
	return 0;
}
function isMax($values) {
		
	foreach ($values as $key => $value ) {

		if (strlen($key) > $value) {
			return 1;
		}
	}
	return 0;
}
function isAlphanumeric($values) {
	for ($i=0; $i<count($values); $i++) {
		$value = $values[$i];
		if (preg_match("/^[A-Za-z0-9 ]*$/", $value) == 0) { 
			return 1; 
		}
	}
	return 0;
}
function isDate($value) { 
	if (preg_match("/^[0-9]{2}+\/[0-9]{2}+\/[0-9]{4}$/", $value) == 0) {
		return 1;
	}
	return 0;
}
function isEmail($value){
	if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $value) == 0) {
		return 1;
	}
	return 0;
}
function isEqual($value1, $value2) {
	if ($value1 != $value2) {
		return 1;
	}
	return 0;
}


/**
 * Converts special chars into html entities
 * @param $value	the value to decode
 */
function decodeSpecialChars($value) {
	$value = str_ireplace("á", "&aacute;", $value);
	$value = str_ireplace("é", "&eacute;", $value);
	$value = str_ireplace("í", "&iacute;", $value);
	$value = str_ireplace("ó", "&oacute;", $value);
	$value = str_ireplace("ú", "&uacute;", $value);
	$value = str_ireplace("Á", "&Aacute;", $value);
	$value = str_ireplace("É", "&Eacute;", $value);
	$value = str_ireplace("Í", "&Iacute;", $value);
	$value = str_ireplace("Ó", "&Oacute;", $value);
	$value = str_ireplace("Ú", "&Uacute;", $value);
	$value = str_ireplace("ñ", "&ntilde;", $value);
	$value = str_ireplace("Ñ", "&Ntilde;", $value);
	return $value;
}

/**
 * Converts html entities into special chars
 * @param $value	the value to encode
 */
function encodeSpecialChars($value) {
	$value = str_ireplace("&aacute;", "á", $value);
	$value = str_ireplace("&eacute;", "é", $value);
	$value = str_ireplace("&iacute;", "í", $value);
	$value = str_ireplace("&oacute;", "ó", $value);
	$value = str_ireplace("&uacute;", "ú", $value);
	$value = str_ireplace("&Aacute;", "Á", $value);
	$value = str_ireplace("&Eacute;", "É", $value);
	$value = str_ireplace("&Iacute;", "Í", $value);
	$value = str_ireplace("&Oacute;", "Ó", $value);
	$value = str_ireplace("&Uacute;", "Ú", $value);
	$value = str_ireplace("&ntilde;", "ñ", $value);
	$value = str_ireplace("&Ntilde;", "Ñ", $value);
	return $value;
}

?>
