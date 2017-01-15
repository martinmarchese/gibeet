<script>
// slider initialization
$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "fade",
		slideDirection: "horizontal",
		slideshow: true,
		slideshowSpeed: 3500,
		animationDuration: 500
	});
});
</script>


<h3 id="modal-title" style="padding:0;padding-left:10px;margin:0">
	Con esta información podremos asesorarte en qué tipo de acción RSE puedes realizar con tu ONG amiga.
</h3>

<div style="float:left;width:520px">
	
	<form id="prospectForm" class="form" onsubmit="return false" style="background-color:transparent; border:none; margin-left:5px; width:530px">

		<label for="type" style="width:160px">Me interesa: </label>
		<select id="type" name="type" class="classic" style="font-size:24px; height:40px">
			<option value="colectaoffline">Colecta offline</option>
			<option value="evento20">Evento 2.0</option>
		</select>
		<br/>
		<label for="state" style="width:160px">Provincia: </label>
		<select id="state" name="state" class="classic" style="font-size:24px; height:40px">
			<option value="Buenos Aires">Buenos Aires</option>
		</select>
		<br/>		
		<label for="city" style="width:160px">Ciudad: </label>
		<select id="city" name="city" class="classic" style="font-size:24px; height:40px">
			<option value="Buenos Aires">Buenos Aires</option>
		</select>
		<br/>
		<label for="colectas_quantity" style="width:160px">Mi presupuesto: </label>
		<select id="colectas_quantity" name="colectas_quantity" class="classic" style="font-size:24px; height:40px">
			<option value="1000">$0 - $1.000</option>
			<option value="10000">$1.000 - $10.000</option>
			<option value="25000">$10.000 - $25.000</option>
			<option value="50000">$25.000 - $50.000</option>
			<option value="100000">+ $50.000</option>
		</select>		
		<br/>
		<div style="padding-right:30px" id="send-container">
			<div id="send-loading" style="float:left; width:380px; padding-top:40px"></div>
			<a class="button-big" style="float:right;margin-top:10px" id="send-button" onclick="$.fn.prospectContact();">Enviar !</a>
		</div>
	</form>
	
	<div id="send-confirmation" style="font-size:23px;line-height:30px;margin-top:60px;text-align:center;margin-right:5px">
	</div>

</div>
<div style="float:left; width:250px; padding-top:15px">
	<img src="images/silla.jpg" width="210"/>
</div>


	
	
	