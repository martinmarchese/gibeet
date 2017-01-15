<?php
include_once 'controller.php';
include '../service/EmailService.class.php';

$form = $_REQUEST["contact_form"];

switch ($form) {
	case "ong":
		$type = " Soy una ONG";
		$content  = " Nombre: ". $_REQUEST["name"]; "\n";
		$content  .= " Email: ". $_REQUEST["email"]; "\n";
		$content  .= " Comentario: ". $_REQUEST["comment"]; "\n";
		break;
		
	case "soporte":
		$type = " Soporte";
		$content  = " Nombre: ". $_REQUEST["name"]; "\n";
		$content  .= " Email: ". $_REQUEST["email"]; "\n";
		$content  .= " Comentario: ". $_REQUEST["comment"]; "\n";
		break;		
		
	case "comercial":
		$type = " Contacto comercial";
		$content  = " Nombre: ". $_REQUEST["name"]; "\n";
		$content .= " Email: ". $_REQUEST["email"]; "\n";
		$content .= " Comentario: ". $_REQUEST["comment"]; "\n";
		break;

	case "planes":
		$type = " Planes servicios";
		$content  = " Nombre: ". $_REQUEST["name"]; "\n";
		$content .= " Email: ". $_REQUEST["email"]; "\n";
		$content .= " Comentario: ". $_REQUEST["comment"]; "\n";
		break;
	
	default:
		include_once 'secure_controller.php';
		
		$type = $_REQUEST["type"];
		$state = $_REQUEST["state"];
		$city = $_REQUEST["city"];
		$colectas_quantity = $_REQUEST["colectas_quantity"];
		
		$content  = " Usuario: ".$loggedUser->username; " \n ";
		$content .= " Nombre: ".$loggedUser->name; " \n ";
		$content .= " ID: ".$loggedUser->idUser; " \n ";
		$content .= " Email: ".$loggedUser->email; " \n ";
		$content .= " Tipo: ".$type. " \n ";
		$content .= " Provincia: ".$state. " \n ";
		$content .= " Ciudad: ".$city. " \n ";
		$content .= " Presupuesto: ".$colectas_quantity. " \n ";
		break;
}

$to = "nico@gibeet.com";

$emailService = new EmailService();
$emailService->sendTextEmail($content, "prospect@gibeet.com.ar", "nico@gibeet.com.ar", "Interesado en ".$type);

print encodeResponse(true, "Tu informaci&oacute;n se ha enviado exitosamente!");
die();
?>
