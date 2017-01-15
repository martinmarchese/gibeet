<?php 
// One time token
$_SESSION["one-time-token"] = sha1(time().KEY);
$token = $_SESSION["one-time-token"];
?>

	<h1>¡Form&aacute; parte de Gibeet!</h1>
	<h3>
		Lleva a tu empresa a un nuevo nivel con la RSE 2.0  y empieza conocer el incre&iacute;ble mundo de la Solidaridad 2.0. 
		<br/><br/>
		Adem&aacute;s de la importancia de ayudar a qui&eacute;n m&aacute;s lo necesita, encontrar&aacute;s cientos de beneficios para tu marca: 
		<i><strong>imagen positiva, fortalecimiento de esp&iacute;ritu a nivel global, fomento de valores y atracci&oacute;n de 
		inversores, entre mucho otros.</strong></i>
	</h3>
	<div style="text-align:center;color:#99CCFF; padding:25px; font-size:20px">
		¿Todav&iacute;a lo est&aacute;s dudando?<strong> ¡Empieza ahora!</strong>
	</div>
	
	<!-- div style="width:100%">
		<div class="registro-prices" style="font-size:18px;">mensual</div>
		<div class="registro-prices" style="font-size:18px;margin-left:95px">semestral</div>
		<div class="registro-prices" style="font-size:18px;margin-left:85px">anual</div>
	</div-->
	
	<div class="form registro-prices" style="width:780px" >
		<div class="inner">
			<span>desde u$s49</span>
			<span class="last">(<s>antes u$s 99</s>) - hasta 50 empleados</span>
			<a onclick="$.fn.showModal(this.id, 550, 360, 'contact_form=planes')" id="contacto" style="font-size:12px" class="button-buy">Lo quiero!</a>
	  </div>
	</div>
	
	<div style="clear:both;text-align: center; font-weight: bold; margin-bottom:30px">
		Haz click en "Lo quiero" y un representante se contactará contigo para acordar contigo el paquete ideal.
	</div>
	
