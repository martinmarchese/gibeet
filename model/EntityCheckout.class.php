<?php

class EntityCheckout {
	
	const TABLE_NAME = "checkout_pref";
	
	public $id;
	public $username;
	public $creation_date;
	public $pref_id;
	public $money;
	
	/**
	 * Getters & Setters
	 */
	public function getTableName() { return self::TABLE_NAME; }
}
?>