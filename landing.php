<?php include_once 'config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
	<meta content="Gibeet.com | RSE 2.0" name="title">
	<meta content="Organice su accion RSE junto a Gibeet.com" name="description">
	<meta content="crowdfunding, crowdfunding argentinas, financiamiento colectivo, financiacion masa, ayuda, RSE, responsabilidad social empresaria, campa�a, marketing solidario, solidaridad, ONG, ONGs, empresa, recaudar dinero, ayuda monetaria, reputacion online, imagen, medio ambiente, social, marketing social, posicionamiento, imagen empresarial, evento corporativo, evento empresarial, evento social, evento beneficiencia, evento caridad" name="Keywords">
	<meta content="es" http-equiv="content-language">
	
	<title>Gibeet.com | RSE 2.0</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="image_src" href="http://www.gibeet.com/images/logo.png"/>
	<link type="text/css" rel="stylesheet" href="css/general.css" />
	<link type="text/css" rel="stylesheet" href="css/form.css" />
	<link type="text/css" rel="stylesheet" href="css/subscribe.css" />
	<link type="text/css" rel="stylesheet" href="css/subscribe.css" />
	<link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" media="all" />
	<link type="text/css" rel="stylesheet" href="css/notify/jquery.pnotify.default.icons.css" media="all" />
	<link type="text/css" rel="stylesheet" href="css/notify/jquery.pnotify.default.css" media="all" />
		
		
		
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/notify/jquery.pnotify.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	
	<meta property="og:title" content="Gibeet.com | RSE 2.0"/>
	<meta property="og:site_name" content="Gibeet"> 
	<meta property="og:image" content="http://www.gibeet.com/images/logo.png"/>	
	
	<script>
	function toggleInput(id) {
		var value = "Ingresa aqui tu correo electronico";
		if ($('#'+id).val() == value) {
			$('#'+id).val("");
		}
	}
	</script>
	
	<!-- 
	GOOGLE ANALYTICS
	 -->
	<?php if (DEPLOY_ENV == "PROD"){ ?>
			<script type="text/javascript">
			   var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-24378772-1']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>
	<?php } ?>
</head>

<body>


<div id="wrapper">
		
	<div id="content" style="margin-top:0px; overflow: visible; width:950px">
		
		<div id="subscribe" style="margin:0">
		
			<div class="header" style="margin:0">		
				<div class="logo">
					<img src="images/logo.png"/>
				</div>
			
				<div class="description" style="padding-top:15px">
					AHORA TU EMPRESA PODR&Aacute; REALIZAR <strong>ACCIONES RSE</strong><br/>
					DE LA MANERA M&Aacute;S SENCILLA.
				</div>
			</div>
		
			<div>
				<center>
					<iframe width="880" height="430" src="http://www.youtube.com/embed/rjp-9PghBZQ" frameborder="0" allowfullscreen></iframe>
				</center>
			</div>
		
			<div class="form" id="form" style="margin:0; margin-top: 20px">
				<input type="text" id="email" name="email" value="Ingresa aqui tu correo electronico" onfocus="toggleInput(this.id)" />
				<input type="hidden" id="ts" name="ts" value="<?php echo time()?>" />
				<input type="submit" value="Enviar!" onclick="$(this).sendProspect()" />
			</div>
		
			<div id="form-comments" style="float:left; font-size:22px; width:100%; padding-top:10px">
				D&eacute;janos tu mail y descubre c&oacute;mo unimos a quien necesita ayuda con quien puede ayudarlo.  
				<br/><br/>
				<a style="font-size:14px;" href="mailto:comercial@gibeet.com?subject=Soy una ONG que quiere recibir ayuda gracias a Gibeet">Soy una ONG que necesita ayuda</a>&nbsp;&nbsp;
				<a style="font-size:14px;" href="mailto:comercial@gibeet.com?subject=Soy una empresa que quiere ayudar utilizando Gibeet">Soy una empresa que quiere ayudar</a>					
			</div>
			<div id="form-social" style="float:left; width:100%; text-align:center; display:none">
				<a href="http://www.facebook.com/pages/Gibeet/160749543986910"><img src="images/fb-big-icon.png" height="40" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://twitter.com/gibeetcom"><img src="images/twitter-big-icon.png" height="40" border="0"></a>
			</div>
		</div>

	</div>

</div>

<div id="footer" style="bottom: inherit; margin-top: 25px;">
	<span style="float:left;padding-left:30px">
		Copyright <?php echo date("Y")?> Gibeet.com. Todos los derechos reservados.
	</span>
	<span style="float:right;">
		<a href="mailto:soporte@gibeet.com">&iquest;Necesitas ayuda?</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:rrhh@gibeet.com">&iquest;Quieres participar?</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:comercial@gibeet.com">&iquest;Alguna propuesta?</a>
	
	</span>
</div>
	
</body>
</html>