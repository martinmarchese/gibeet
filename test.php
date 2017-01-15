<?php
include 'config/constants.php';
include_once 'library/JSON.php';
include_once 'library/Validations.php';
include_once 'service/CheckoutService.class.php';


$c = new CheckoutService();

$res = $c->getMoneyAndCollaboratorsByUsername("título_de_lo_que_est&aacu...");

echo $res;