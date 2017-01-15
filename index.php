<?php
session_start(); 
include_once 'config/constants.php'; 
include_once 'controller/section_handler.php';
include_once 'library/Secure.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<?php 
	include('layout/head.php');
?>

<body>
<?php
	// Cross sections notifications 
	include('library/notification.php'); 
?>

<div id="wrapper">

	<div id="header">
		<?php include('layout/header.php'); ?>
	</div>

	<?php if ($page != "timeline") { ?>
		<div id="content"><?php include($page.".php"); ?></div>
	<?php } else {
			 include($page.".php");
		  } ?>
</div>

<div id="footer">
	<?php include('layout/footer.php'); ?>
</div>

	
</body>
</html>