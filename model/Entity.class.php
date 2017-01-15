<?php

class Entity {
	
	const TABLE_NAME = "entity";
	
	public $id;
	public $username;
	public $name;
	public $timelineImage;
	public $description;
	public $keywords;
	public $money;
	public $facebook;
	public $twitter;
	public $youtube;
	public $address;
	public $country;
	public $state;
	public $city;
	public $type;
	public $colectas_quantity;
	
	public function getTableName() { return self::TABLE_NAME; }
	
}

?>
