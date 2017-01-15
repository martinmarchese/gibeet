<?php
include 'controller.php';
include '../service/CheckoutService.class.php';

$username = trim($_POST["username"]);

$checkoutService = new CheckoutService();
$money = @$checkoutService->getMoneyAndCollaboratorsByUsername($username);

if($money !== false){
	$json = new Services_JSON;
	print $json->encode($money);
}
die();

?>