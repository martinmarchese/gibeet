<?php
include_once 'Database.class.php';

//TODO: implementar SSL para el login
//TODO: KEY debe regenerarse cada tanto
class UserService {
	
	private $html;
	
	private $xpath;

	private function generateCookie($id, $expiration) {

		$key = hash_hmac( 'sha512', $id . $expiration, KEY );
		$hash = hash_hmac( 'sha512', $id . $expiration, $key );

		$cookie = $id . '|' . $expiration . '|' . $hash;
		return $cookie;
	}
	
	private function setCookie($id, $remember = false ) {

		if ($remember) {
			$expiration = time() + 1209600; // 14 days
		} else {
			$expiration = time() + 172800; // 48 hours
		}

		$cookie = $this->generateCookie($id, $expiration);	
		if ( !setcookie( COOKIE_AUTH, $cookie, $expiration, COOKIE_PATH, COOKIE_DOMAIN, false, true ) ) {
		}
	}
	
	private function setSession($user) {
		$_SESSION["USER"] = serialize($user);
		$_SESSION["AUTH"] = OK_AUTH;
	}
	
	/**
	 * This method must be called after any request
	 */
	public function verifyCookie() {
		if ( empty($_COOKIE[COOKIE_AUTH]) ) {
			return false;
		}
			
	
		list($id, $expiration, $hmac) = explode('|', $_COOKIE[COOKIE_AUTH]);
	
		$expired = $expiration;
		if ($expired < time()) {
			return false;
		}
		$key = hash_hmac( 'sha512', $id . $expiration, KEY);
		$hash = hash_hmac( 'sha512', $id . $expiration, $key);
	
		if ($hmac != $hash) {
			return false;
		}
		return true;
	}
		
	/**
	 * Creates a secure hash for password
	 */
	public function getPasswordHash($pass) {
		$salt = substr(hash('sha512', KEY), 0, 15);
	    return hash('sha512', $salt . KEY. $pass).$salt;
	}
	
	/**
	 * Authenticates a user
	 */
	public function authenticate($user){
		
		$username = strtolower($user->username);
		
		$db = Database::getInstance();
		$sql  = "SELECT * FROM ".$user->getTableName();
		$sql .= " WHERE username = '".mysql_real_escape_string($username)."'";
		$sql .= "   AND password = '".$this->getPasswordHash($user->password)."'";
		$sql .= " LIMIT 1";		
		$db->setQuery($sql);

		$authUsr = $db->loadObject(get_class($user));
	
		if ($authUsr != null) {
			$this->setCookie($authUsr->idUser);
			$this->setSession($authUsr);
		} else {
			throw new Exception("Usuario o contrasena incorrectos");
		}
		return $authUsr;
	}

	
	/**
	 * User registration
	 */
	public function register($user) {
		
		$password = $this->getPasswordHash($user->password);
		$username = strtolower($user->username);
		$email    = strtolower($user->email);
		
		$db = Database::getInstance();		
		$sql  = "INSERT INTO ".$user->getTableName();
		$sql .= " 			(date, username, email, position, name, image, password) ";
		$sql .= "	  VALUES('".date(DATE_DB_FORMAT)."','".mysql_real_escape_string($username)."','".mysql_real_escape_string($email)."',";
		$sql .= "			 '".mysql_real_escape_string($user->position)."',";
		$sql .= "			 '".mysql_real_escape_string($user->name)."', 'profile', '".$password."');";	
		$db->setQuery($sql);
		$res = $db->execute();
		return $res;
	}
	
	/**
	 * Checks if an user exitst
	 */
	public function exists($user){
		
		global $RESTRICTED_USERNAMES;
		$username = strtolower($user->username);
		$email = strtolower($user->email);
		
		if (in_array($username, $RESTRICTED_USERNAMES)) {
			return $user;
		}	
		
		$db = Database::getInstance();
		$sql  = "SELECT * FROM ".$user->getTableName();
		$sql .= " WHERE (username = '".mysql_real_escape_string($username)."'";
		$sql .= "    OR email = '".mysql_real_escape_string($email)."')"; 
		$sql .= "  LIMIT 0,1";
		$db->setQuery($sql);	
		return $db->loadObject(get_class($user));
	}	
	
	/**
	 * Saves user image in DB
	 */
	public function saveImage($filename,$idUser){
		$db = Database::getInstance();
		$user = new User();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "   SET image = '".$filename."'";
		$sql .= " WHERE idUser = '".mysql_real_escape_string($idUser)."'";
		$db->setQuery($sql);
		return $db->execute();
	}
	
	/**
	 * Gets a User
	 * @param $id 	User ID
	 */
	public function get($id){
		$db = Database::getInstance();
		$user = new User();
		$reflection = new ReflectionClass($user);
		$idUser = $reflection->getProperty("idUser");	
		
		$sql  = "SELECT * FROM ".$user->getTableName();
		$sql .= " WHERE idUser = '".mysql_real_escape_string($id)."'";
		$sql .= "  LIMIT 0,1";
		$db->setQuery($sql);		
		return $db->loadObject(get_class($user));	
	}
		
	/**
	 * Gets a User by username
	 */
	public function getByUsername($username){
		$db = Database::getInstance();
		$user = new User();
		$reflection = new ReflectionClass($user);
		$usernameProp = $reflection->getProperty("username");	
		
		$sql  = "SELECT * FROM ".$user->getTableName();
		$sql .= " WHERE ".$usernameProp->getName()." = '".mysql_real_escape_string($username)."'";
		$db->setQuery($sql);
		return $db->loadObject(get_class($user));			
	}	
	
	/**
	 * Sets a timestamp and code for a user.
	 * Its used for forgot password feature
	 * @param $username User to set TS and code
	 * @param $code		Code to set
	 */
	public function setTSandCode($username, $code){
		$db = Database::getInstance();
		$user = new User();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "   SET code = '".$code."',";
		$sql .= "       code_ts = INTERVAL 1 DAY + CURDATE()";
		$sql .= " WHERE username = '".mysql_real_escape_string($username)."'";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);		
		return $db->execute();
	}

	/**
	 * Verify timestamp and code.
	 */
	public function verifyTSandCode($code){
		$db = Database::getInstance();
		$user = new User();
		$sql  = "SELECT * FROM ".$user->getTableName();
		$sql .= " WHERE code = '".mysql_real_escape_string($code)."'";
		$sql .= "   AND code_ts > CURDATE()";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		return $db->loadObject(get_class($user));
	}
	
	/**
	 * Update user password
	 */
	public function updatePassword($idUser, $password){
		$db = Database::getInstance();
		$user = new User();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "   SET code = '0',";
		$sql .= "       code_ts = '1000-01-01',";
		$sql .= "       password = '".$password."'";
		$sql .= " WHERE idUser = '".$idUser."'";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		return $db->execute();
	}
	
	/**
	 * Update user profile
	 */
	public function updateProfile($user){
		$db = Database::getInstance();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "   SET name  = '".mysql_real_escape_string($user->name)."',";
		$sql .= "		email = '".mysql_real_escape_string($user->email)."',";
		$sql .= "		position = '".mysql_real_escape_string($user->position)."',";
		$sql .= "       birth = '".mysql_real_escape_string($user->birth)."',";
		$sql .= "       country = '".mysql_real_escape_string($user->country)."',";
		$sql .= "       city = '".mysql_real_escape_string($user->city)."'";
		$sql .= " WHERE idUser = '".$user->idUser."'";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		return $db->execute();
	}


	/**
	 * Adds an entity to a user
	 * @param $user			the logged user object
	 * @param $username		the entity username
	 */
	public function addFriendEntity($user, $username) {
		$db = Database::getInstance();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "	SET friend_entity = '".mysql_real_escape_string($username)."'";	
		$sql .= " WHERE idUser = '".$user->idUser."'";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		return $db->execute();
	}
	
	/**
	 * Deletes the entity frien of the logged user
	 * @param $user			the logged user object
	 */
	public function deleteFriendEntity($user) {
		$db = Database::getInstance();
		$sql  = "UPDATE ".$user->getTableName();
		$sql .= "	SET friend_entity = ''";	
		$sql .= " WHERE idUser = '".$user->idUser."'";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		return $db->execute();
	}

	/**
	 * Gets the entity friend of the given user
	 * @return null if user doesnt have an entity friend. Otherwise returns the entity username  
	 */
	public function getFriendEntity($user) {
		
		$entity = new Entity();
		$db = Database::getInstance();
		$sql  = "SELECT e.* FROM user u, entity e";	
		$sql .= " WHERE u.idUser = '".$user->idUser."'";
		$sql .= "   AND u.friend_entity = e.username";
		$sql .= " LIMIT 1";
		$db->setQuery($sql);
		$db->execute();
		
		$res = $db->loadObject(get_class($entity));
		return $res;
	}
}
?>