<?php

class User {
	
	const TABLE_NAME = "user";
	
	public $idUser;
	public $username;
	public $name;
	public $position;
	public $email;
	public $friend_entity;
	public $password;
	public $image;
	public $country;
	public $birth;
	public $accountId;
	public $accountCode;
	public $accountToken;

	
	/**
	 * Getters & Setters
	 */
	public function getTableName() { return self::TABLE_NAME; }
	
}

?>