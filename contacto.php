<?php

$contact_form = $_GET["contact_form"];

$contact_title = "<h2>Estamos ansiosos por charlar contigo!</h2>";
if ($contact_form == "planes") {
	$contact_title = "<h3><b><center>&iquest;Te interesa alguno de nuestros planes? D&eacute;janos tus datos y un representante se contactar&aacute; contigo</center></b></h3>";
}
?>

<div class="modal-title" style="margin-bottom:0">Comun&iacute;cate con nuestro equipo</div>

<div id="modal-content">
	
	<?php echo $contact_title ?>

	<form id="prospectForm" class="form" onsubmit="return false" style="float:left;background-color:transparent; border:none; margin:0; margin-top:15px; width:545px">
		<input type="hidden" id="contact_form" name="contact_form" value="<?php echo $contact_form?>" />
		
		<label for="name" style="width:160px;font-size:14px">Nombre: </label>
		<input id="name" name="name" type="text" class="classic" style="font-size:20px; height:25px">
		<br/>
		<label for="email" style="width:160px;font-size:14px">E-Mail: </label>
		<input id="email" name="email" type="text" class="classic" style="font-size:20px; height:25px">
		<br/>		
		<label for="comment" style="width:160px;font-size:14px">Cu&eacute;ntanos algo: </label>
		<textarea id="comment" name="comment" class="classic" style="font-size:20px; height:80px"></textarea>
		<br/>
		<div style="padding-right:30px" id="send-container">
			<div id="send-loading" style="float:left; width:380px; padding-top:40px"></div>
			<a class="button" style="float:right;margin-top:10px" id="send-button" onclick="$.fn.prospectContact();">Enviar !</a>
		</div>
	</form>
	
	<div id="send-confirmation" style="float:left; font-size:23px;line-height:30px;margin-top:0px;text-align:center;margin-right:5px">
	</div>

	
	
</div>