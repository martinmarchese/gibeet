<?php
/* -- Enviroment to Deploy --
 * Setear DEPLOY_ENV segun el entorno donde se deploye la aplicacion. Se modificaran automaticamente
 * todas las configuraciones de la aplicacion acorde al ambiente elegido.
 * 'DEV'	Ambiente de desarrollo
 * 'PROD' 	Ambiente productivo
 * Ademas se deben definir para cada entorno las variables requeridas para cada configuracion.
 * e.g: DB_HOST,DB_USER ,...
 *************************************************************************************/
$env = strtolower($_SERVER["SERVER_NAME"]);
if ($env == "127.0.0.1" || $env == "localhost") {
	define('DEPLOY_ENV','DEV');	
} else {
	define('DEPLOY_ENV','PROD');	
}


// - Development
if (DEPLOY_ENV == "DEV"){
	define('HOST','http://localhost');
	define('INC_PATH','/solonline/gibeet/new');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_DATABASE','listas');
	define('DOMAIN','127.0.0.1');
	define('COOKIE_DOMAIN', '127.0.0.1');
	define('MP_CLIENT_ID','3619');
	define('MP_CLIENT_SECRET', 'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn');
}
// - Production
if (DEPLOY_ENV == "PROD"){
	define('HOST','http://www.gibeet.com.ar');
	define('INC_PATH','');
	define('DB_HOST','mysql1.000webhost.com');
	define('DB_USER','a3561322_root');
	define('DB_PASSWORD','asomo560jota');
	define('DB_DATABASE','a3561322_listas');
	define('DOMAIN','.gibeet.com.ar');
	define('COOKIE_DOMAIN', 'gibeet.com.ar');
	define('MP_CLIENT_ID','3619');		// TODO: configurar MercadoPago Gibeet.com !!
	define('MP_CLIENT_SECRET', 'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn');
}
/*************************************************************************************
*************************************************************************************/

// SESSION & SYSTEM CONSTANTS
$SECURE_PAGES = array("panel","panel.php");
define('KEY','LKJHGFDDghj8o875i4409ir34mu5498gmu4t98u698hu98hu5698hmurjklfjf8wq22379487');
define('COOKIE_PATH', '/');
define('MAX_LOGIN_ATTEMPS', 15);
define('LOGIN_BLOCK_EXPIRE_OFFSET', 300);
define('OK_AUTH', 'yes');

$RESTRICTED_USERNAMES = array("gibeet", "gibeet.com", "gibeetcom", "admin", "soporte", "support",
				 "ayuda", "logout", "login", "registro", "servicios", "panel", "home",
				 "config", "controller", "css", "entities", "images", "js", "layout", "library", 
				"model", "notification", "service");

// APP CONSTANTS 
define('DATE_APP_FORMAT','d/m/y');
define('DATE_DB_FORMAT','Y-m-d');


// FORM CONSTANTS
define('MAX_USUARIO','20');
define('MAX_PUESTO','50');
define('MAX_NOMBRE','50');
define('MAX_MAIL','200');
define('MAX_PASSWORD','20');
define('MAX_BIRTH','10');
define('MAX_COUNTRY','20');
define('MAX_CITY','50');


$country_form_list = array("Argentina", "Bolivia", "Chile", "Colombia", "Costa Rica", "Cuba", "Ecuador", "El Salvador", "España", "Guatemala",
						   "Honduras", "Mexico", "Nicaragua", "Panamá", "Paraguay", "Peru", "Puerto Rico", "República Dominicana", "Uruguay", "Venezuela");

?>