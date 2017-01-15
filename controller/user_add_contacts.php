/**
 * Save contacts
 */
function contactController_saveContacts(){
	session_start();
	$contacts = $_POST["contacts"];
	$idUser = $_SESSION["uid"];	
	
	if (count($contacts) < 1){
		print getJSONMessage(false,"No se ha seleccionado ningun contacto a guardar");
		die();
	}
	
	// Converts queryString into contact objects
	for ($i=0; $i<count($contacts); $i++) {
		$data = explode('|', $contacts[$i]);
		$c = new Contact();
		$c->setIdUser($idUser);
		$c->setName(trim($data[1]));
		$c->setEmail(trim($data[0]));
		$contactList[$i] = $c;
	}
	
	// Save contacts
	$contactService = new ContactService();
	$contactService->saveContacts($contactList,$idUser);

	print getJSONMessage(true,"Se han guardado los contactos con exito!");
	die();
}


/**
 * Send notifications to all user contacts
 */
function contactController_recommendListToContacts(){
	session_start();
	$idUser = $_SESSION["uid"];
	$username = $_SESSION["username"];
	
	// Get user contacts
	$contactService = new ContactService();
	$contacts = $contactService->getUserContacts($idUser);
	
	// Params to replace in email
	$params["username"] = $username;
	$params["entity"] = "lista";
	
	// Send email to contacts
	$emailService = new EmailService();
	for ($i=0; $i < count($contacts); $i++){
		$emailService->sendHTMLEmail("../notification/ListNotification.php",NOTIFICATION_MAIL,$contacts[$i]->getEmail(),
									$contacts[$i]->getName(). " ".$username." ha creado una lista en giBeet",$params);
		sleep(0.1);
	}
}