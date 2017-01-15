<?php
session_start();
@include_once 'config/constants.php';
@include_once 'model/User.class.php';
@include_once 'service/UserService.class.php';


function getCurrentPage() {
	$path = explode('/', $_SERVER["PHP_SELF"]);
	$current_page = $path[count($path)-1];
	return $current_page;
}

function getCurrentDirectory() {
	$path = explode('/', $_SERVER["PHP_SELF"]);
	$current_dir = $path[count($path)-2];
	return $current_dir;
}

function getLoggedUser() {
	if (UserService::verifyCookie()) {
	
		list($id, $expiration, $hmac) = explode('|', $_COOKIE[COOKIE_AUTH]);
	
		$userService = new UserService();
		$loggedUser = $userService->get($id);
		return $loggedUser;
	}
}

function isLogged() {
	
	return ( UserService::verifyCookie() && $_SESSION["AUTH"] == OK_AUTH && isset($_SESSION["USER"]) );
}

function isSecurePage($page) {
	global $SECURE_PAGES;
	$page = strtolower($page);

	$current_page = getCurrentPage();

	if (in_array($page, $SECURE_PAGES) || in_array($current_page, $SECURE_PAGES) ) {

		return true;
	} else {
		
		return false;
	}
}


if (!isLogged() && isSecurePage($sk)) {
?>
	<script>
		location.href = "login";
	</script>
<?php
die();
}
?>