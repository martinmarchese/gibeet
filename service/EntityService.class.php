<?php
include_once 'Database.class.php';

class EntityService {
	
	/**
	 * Converts special charts into html entities
	 * @param $value	the value to decode
	 */
	public function decodeSpecialChars($value) {
		$value = str_ireplace("á", "&aacute;", $value);
		$value = str_ireplace("é", "&eacute;", $value);
		$value = str_ireplace("í", "&iacute;", $value);
		$value = str_ireplace("ó", "&oacute;", $value);
		$value = str_ireplace("ú", "&uacute;", $value);
		$value = str_ireplace("Á", "&Aacute;", $value);
		$value = str_ireplace("É", "&Eacute;", $value);
		$value = str_ireplace("Í", "&Iacute;", $value);
		$value = str_ireplace("Ó", "&Oacute;", $value);
		$value = str_ireplace("Ú", "&Uacute;", $value);
		$value = str_ireplace("ñ", "&ntilde;", $value);
		$value = str_ireplace("Ñ", "&Ntilde;", $value);
		return $value;
	}
	
	/**
	 * Gets an entity by username
	 * @param $username	the entity username
	 */
	public function getByUsername($username) {
		
		$db = Database::getInstance();
		$entity = new Entity();
		$reflection = new ReflectionClass($entity);
		$usernameProp = $reflection->getProperty("username");	
		
		$sql  = "SELECT * FROM ".$entity->getTableName();
		$sql .= " WHERE ".$usernameProp->getName()." = '".mysql_real_escape_string($username)."'"; 
		$sql .= " LIMIT 0,1";

		$db->setQuery($sql);
		return $db->loadObject(get_class($entity));	
	}
	
	/**
	 * Entity search
	 */
	public function search($criteria) {
		
		$db = Database::getInstance();
		$entity = new Entity();

		$criteria = mysql_real_escape_string($criteria);
		$criteria = str_ireplace("ó", "ó", $criteria);

		$sql .= "SELECT * FROM ".$entity->getTableName();
		$sql .= " WHERE lower(username) LIKE ('%". $criteria . "%')";
		$sql .= "    OR lower(name) LIKE ('%". $criteria . "%')";
		$sql .= "    OR lower(description) LIKE ('%". $criteria . "%')";
		$sql .= "    OR lower(keywords) LIKE ('%". $criteria . "%')";
		$sql .= " LIMIT 0, 30";	
		
		$db->setQuery($sql);
		return $db->loadObjectList(get_class($entity));	
	}
	
	
	/**
	 * Gets entity news
	 */
	public function getEntityActivity($username) {
		
		$db = Database::getInstance();
		$news = new News();
		$sql  = "SELECT * FROM ".$news->getTableName();
		$sql .= " WHERE entity = '".$username."'"; 
		$sql .= " ORDER BY date DESC";
		$sql .= " LIMIT 0,9";
		$db->setQuery($sql);
		return $db->loadObjectList(get_class($news));
	}
}

?>