<?php

	/**
	 * Section HANDLER
	 */
	if (isset($_GET['sk'])){
		$sk = $_GET['sk'];
	} else {
		$sk = "";
	}

	// IMPORTANTE! Cada nombre de seccion tiene que agregarse a la constante $RESTRICTED_USERNAMES
	switch ($sk) {
		
		case "registro":
			$title = "Registrate, se parte de nuestra comunidad y ayuda a miles de personas!";
			$description = "¿Sos Empresa? ¿ONG? Doná y conseguí donaciones";
			$page = "registro";
			break;
			
		case "servicios":
			$title = "Qué ofrecemos";
			$description = "Colectas, Donaciones, Eventos, RSE, Eventos solidarios e Intervenciones solidarias.";
			$page = "servicios";
			break;
			
		case "login":
			$title = "Login";
			$description = "Ingresá a Gibeet y construí tu RSE 2.0"; 
			$page = "login";
			break;			

		case "panel":
			$title = "Mi panel - Consigue una ONG amiga y ayúdala.";
			$description = "Consigue una ONG amiga y ayúdala.";
			$page = "panel";
			break;
			
		case "noticias":
			$title = "Noticias";
			$description = "Novedades de nuestra entidad amiga";
			$page = "noticias";
			break;
			
		case "logout":
			$title = "";
			$description = "";
			$page = "logout";
			break;
			
		case "motivos":
			$title = "Las claves de la RSE 2.0";
			$description = "Los beneficios de formar parte de Gibeet";
			$page = "motivos";
			break;

		case "retrievepassword":
			$title = "Recupera tu contraseña";
			$description = "";
			$page = "retrievepassword";
			break;
			
		case "":
			$title = "RSE 2.0 - Responsabilidad y Solidaridad. Espíritu 2.0";
			$description = "¿Sos una empresa? ¿Sos una ONG? Unimos a quienes pueden ayudar con quienes necesitan ayuda.";
			$page = "home";
			break;
			
		case "home":
			$title = "RSE 2.0 - Responsabilidad y Solidaridad. Espíritu 2.0";
			$description = "¿Sos una empresa? ¿Sos una ONG? Unimos a quienes pueden ayudar con quienes necesitan ayuda.";
			$page = "home";
			break;

		default:	// Is an Entity
			include_once 'model/User.class.php';
			include_once 'model/Entity.class.php';
			include_once 'service/UserService.class.php';
			include_once 'service/EntityService.class.php';
			
			// Get the entity information
			$username = $sk;
			$entity = EntityService::getByUsername($username);
			$title = $entity->name;
			$description = $entity->description;
			
			if ($entity == null) { header("location:home"); };

			$page = "timeline";			
			
			$empresa = $_GET["empresa"]; // nombre de empresa referida
			break;
	}

?>