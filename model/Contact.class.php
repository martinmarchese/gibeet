<?php 

class Contact {
	
	const TABLE_NAME = "contact";
	
	public $id;
	public $idUser;
	public $date;
	public $name;
	public $email;

	/**
	 * Getters & Setters
	 */
	public function getTableName() { return self::TABLE_NAME; }	
	
}
?>
