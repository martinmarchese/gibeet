<?php
session_start();

	if ($_SESSION["NOTIFICATION"] != "") {
?>
		<script>
		$(document).ready(function() {
			$.fn.notification('<?php echo $_SESSION["NOTIFICATION"]?>');
		});
		</script>

<?php 
	}
	$_SESSION["NOTIFICATION"] = "";
?>