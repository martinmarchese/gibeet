<?php
class News {
	
	const TABLE_NAME = "news";
	
	public $id;
	public $entity;
	public $date;
	public $title;
	public $text;
	
	public function getTableName() { return self::TABLE_NAME; }
}

?>