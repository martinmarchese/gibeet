<?php

class ContactService {


	/**
	 * Get email contacts
	 */
	public function getContacts($email,$password,$emailClient){

		$inviter = new OpenInviter();
		@$inviter->startPlugin($emailClient);
    	@$res = $inviter->login($email,$password);
    	if (!$res) { return null; }
       
     	$contacts = @$inviter->getMyContacts();
     	  
    	@$inviter->stopPlugin(true);
        @$inviter->logout();
        
        return $contacts;
	}
	
	
	/**
	 * Save email contacts
	 */
	public function saveContacts($contacts, $idUser) {
		$db = Database::getInstance();
		$contact = new Contact();
		
		$sql = "";
		for ($i=0; $i<count($contacts); $i++){
			$sql  = " INSERT INTO ".$contact->getTableName();
			$sql .= " (idUser,date,name,email) VALUES ('".$idUser."','".date(DATE_DB_FORMAT)."','".mysql_escape_string($contacts[$i]->name)."','".mysql_escape_string($contacts[$i]->email)."'); ";
			$db->setQuery($sql);
			$db->execute();
		}
		//TODO: ver como hacer para registros que no se puedan insertar
	}
	
	/**
	 * Get user contacts
	 */
	public function getUserContacts($idUser){
		$db = Database::getInstance();
		$contact = new Contact();
		$sql  = "SELECT * FROM ".$contact->getTableName();
		$sql .= " WHERE idUser = '".mysql_escape_string($idUser)."'";
		$db->setQuery($sql);
		return $db->loadObjectList(get_class($contact));
	}
	
	
	/**
	 * Delete email contacts
	 */
	public function deleteContacts($contacts, $idUser) {
		$db = Database::getInstance();
		$contact = new Contact();
		
		$sql = "";
		for ($i=0; $i<count($contacts); $i++){
			$sql  = " DELETE FROM ".$contact->getTableName();
			$sql .= "  WHERE idUser = '".$idUser."'";
			$sql .= "    AND id = '".$contacts[$i]->id."'";
			$db->setQuery($sql);
			$db->execute();
		}
		//TODO: ver como hacer para registros que no se pudieron eliminar
	}
}