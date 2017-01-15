<?php
include_once 'secure_controller.php';
include_once '../model/Entity.class.php';
include_once '../model/EntitySearchResult.class.php';
include_once '../library/Validations.php';
include_once '../service/EntityService.class.php';

$search = trim(strtolower($_POST["inputSearch"]));

// Validations
$valid = 0;
$valid += isRequired(array($search));

if ($valid > 0) {
	print encodeResponse(false, "Has olvidado ingresar el criterio de b&uacute;squeda.");
	die();
}

$search = substr($search, 0, 80);

$entityService = new EntityService();
$results = $entityService->search($search);

for ($i=0; $i < count($results); $i++) {

	$entitySearchResult = new EntitySearchResult();
	$entitySearchResult->id = $results[$i]->id;
	$entitySearchResult->name = $results[$i]->name;
	$entitySearchResult->username = $results[$i]->username;
	$entitySearchResult->description = substr($results[$i]->description, 0, 200) . " ...";
	$entitySearchResults[$i] = $entitySearchResult;	
}


if ($results == null) {
	print encodeResponse(false, "No hay resultados para tu b&uacute;squeda. Intenta con otro criterio de b&uacute;squeda y tendr&aacute;s m&aacute;s suerte!");
	die();
}

print encodeObjectResponse(true, "Encontramos estas entidades !!!", $entitySearchResults);
die();


?>