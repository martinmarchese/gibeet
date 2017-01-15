<?php
session_destroy(); 

$_SESSION["NOTIFICATION"] = "Gracias por compartir tiempo junto a nosotros! Podr&aacute;s regresar cuando desees.";
?>

<script>
	location.href = "login";
</script>