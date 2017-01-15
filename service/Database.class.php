<?php

class Database {
	
	// Database credentials
	const HOST = DB_HOST;
	const USER = DB_USER;
	const PASSWORD = DB_PASSWORD;
	const DATABASE = DB_DATABASE;
	
	private $conexion;
	private $resource;
	private $sql;
	public static $queries;
	private static $_singleton;

	/**
	 *  Singleton
	 */
	public static function getInstance()
	{
		if (is_null (self::$_singleton)) 
		{
			self::$_singleton = new DataBase();
		}
		return self::$_singleton;
	}

	/**
	 * Makes the conexion with server
	 */
	private function __construct()
	{
		$this->conexion = @mysql_connect(self::HOST,self::USER,self::PASSWORD);
		mysql_set_charset('utf8', $this->conexion);
		mysql_select_db(self::DATABASE, $this->conexion);
		self::$queries = 0;
		$this->resource = null;
	}

	/**
	 * Alter 
	 */ 
	public function alter(){
		if(!($this->resource = mysql_query($this->sql, $this->conexion))){
			return false;
		}
		return true;
	}
	
	
	/**
	 * Set the query
	 */
	public function setQuery($sql)
	{
		if(empty($sql)){
			return false;
		}
		$this->sql = $sql;
		return true;
	}
	

	/**
	 * Executes the query
	 */
	public function execute()
	{
		if(!($this->resource = mysql_query($this->sql, $this->conexion))){
			return null;
		}
		self::$queries++;
		return $this->resource;
	}

	
	/**
	 * Load a specific object list with results
	 */
	public function loadObjectList($className) {
		if (!($cur = $this->execute()))
		{
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_object($cur,$className)){
			$array[] = $row;
		}
		return $array;	
	}
	
	
	/**
	 * Load a generic object list with results 
	 */
	public function loadGenericObjectList()
	{
		if (!($cur = $this->execute()))
		{
			return null;
		}
		$array = array();
		while ($row = @mysql_fetch_object($cur)){
			$array[] = $row;
		}
		return $array;
	}
	
	
	/**
	 * Load a specific object 
	 */
	public function loadObject($className)
	{
		if ($cur = $this->execute()){
			if ($object = mysql_fetch_object($cur,$className)){
				@mysql_free_result($cur);
				return $object;
			}
			else {
				return null;
			}
		}
		else {
			return false;
		}
	}
	
	
	/**
	 * Load an generic object 
	 */
	public function loadGenericObject()
	{
		if ($cur = $this->execute()){
			if ($object = mysql_fetch_object($cur)){
				@mysql_free_result($cur);
				return $object;
			}
			else {
				return null;
			}
		}
		else {
			return false;
		}
	}

	
	/**
	 * Free resources 
	 */
	public function freeResults()
	{
		@mysql_free_result($this->resource);
		return true;
	}


	/**
	 * Destroy the object 
	 */
	function __destruct()
	{
		@mysql_free_result($this->resource);
		@mysql_close($this->conexion);
	}
}
?>
