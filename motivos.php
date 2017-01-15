<script>
$(document).ready(function() {
	
	$(window).scroll(function () { 
		if (window.scrollY > 10) {
			$('#faq-menu').css('top', (window.scrollY - 70) + 'px');
		} else {
			$('#faq-menu').css('top', 0);
		}
	});
});
</script>

<div>

<div style="position:relative">
	<ul id="faq-menu" class="faq-options" style="left:750px">
		<li class="title">FAQs</li>
		<li class="subtitle">Sobre Gibeet</li>
		<li onclick="$.scrollTo('#f1', 1000)">¿Qué es Gibeet?</li>
		<li onclick="$.scrollTo('#f2', 1000)">¿Cómo funciona?</li>
		<li onclick="$.scrollTo('#f3', 1000)">¿Cómo encuentro ONGs?</li>
		
		<li class="subtitle">Recibir y dar ayuda</li>
		<li onclick="$.scrollTo('#f4', 1000)">Soy una ONG</li>
		<li onclick="$.scrollTo('#f5', 1000)">Soy un individuo</li>
		<li onclick="$.scrollTo('#f6', 1000)">Soy una empresa</li>
		
		<li class="subtitle">¿Por que?</li>
		<li onclick="$.scrollTo('#f7', 1000)">Ventajas RSE</li>
		<li onclick="$.scrollTo('#f8', 1000)">Beneficios</li>
		<li onclick="$.scrollTo('#f9', 1000)">Nuestro valor</li>
		
		<li class="subtitle">Nuestros servicios</li>
		<li onclick="$.scrollTo('#f10', 1000)">Colectas 2.0</li>
		<li onclick="$.scrollTo('#f11', 1000)">Donaciones 2.0</li>
		<li onclick="$.scrollTo('#f12', 1000)">Eventos 2.0</li>
		
		<li class="subtitle">Costos</li>
		<li onclick="$.scrollTo('#f13', 1000)">Servicios</li>
		<li onclick="$.scrollTo('#f14', 1000)">MercadoPago</li>
		
		<li onclick="$.scrollTo('#f15', 1000)" class="subtitle" style="cursor:pointer">Seguridad y privacidad</li>
	</ul>
</div>

<div id="modal-content" style="background-color:white; padding:20px; overflow:hidden; width:73%">

	<h1>FAQ - Las claves de la RSE 2.0</h1> 

	<div class="faq-container">
	
		<!-- Sobre Gibeet -->
			<div class="faq" id="f1">
				<h2>¿Qué es Gibeet?</h2>
				<span>
					Gibeet es una herramienta que permite a las empresas, realizar acciones RSE de manera sencilla, r&aacute;pida y econ&oacute;mica.
					Mezclamos conceptos como: crowdfunding, redes sociales, difusi&oacute;n y comunicaci&oacute;n. Unimos a quienes pueden ayudar con quien necesita ayuda. <br/> 
					Fomentamos y creamos la RSE 2.0, mediante la cual, diferentes empresas pueden ayudar a organizaciones sin fines de lucro, 
					de formas creativas e innovadoras.
				</span>
			</div>
			
			<div class="faq" id="f2">
				<h2>¿Cómo funciona?</h2>
				<span>
					Las empresas dispuestas a realizar acciones de RSE, encuentran mediante Gibeet diferentes ONG a las que 
					pueden ayudar. Ser&aacute;n ONG con necesidades a medida de las posibilidades de cada empresa. <br/>
					Una vez elegida la ONG - es decir, una vez que hace de esa ONG, una entidad amiga -, la empresa podr&aacute; 
					elegir una de las 3 formas de ayudar que ofrecemos en Gibeet:  Colectas 2.0 Donaciones 2.0 y Eventos 2.0.
				</span>
			</div>
	
			<div class="faq" id="f3">
				<h2>¿Cómo encuentro una ONG?</h2>
				<span>
					Si ya te encuentras registrado, inicia tu sesión en Gibeet. En la sección, - <i>Mis acciones RSE</i> - podrás encontrar a la ONG que se adapte 
					a tu empresa. Para ello, utiliza el buscador con el criterio de búsqueda que desees. Una vez que elijas la ONG a la que quieres ayudar,
					haz click para hacerla tu amiga y así iniciar actividades RSE con ella.
				</span>
			</div>
	
		<!-- Recibir y dar ayuda -->
			<div class="faq" id="f4">
				<h2>Soy una ONG</h2>
				<span>
					Si eres una ONG y necesitas ayuda, completa los datos de la misma en el formulario al que accederás mediante el link.
					 Una vez completado, serás contactado por personal de Gibeet para pasar a formar parte de nuestra base de 
					 ONG a las que acceden las empresas dispuestas a ayudar. <a href="mailto:ongs@gibeet.com">Contactanos</a>
				</span>
			</div>

			<div class="faq" id="f5">
				<h2>Soy un individuo</h2>
				<span>
					Si eres un individuo tambi&eacute;n puedes ayudar a cumplir los sue&ntilde;os de las diferentes ONG. Reg&iacute;strate en Gibeet y en 
					el buscador encontrar&aacute;s los sueños vigentes que las diferentes Empresas est&aacute;n cumpliendo. <br/>
					&iexcl;Podr&aacute;s donar la cantidad de dinero que desees!.
				</span>
			</div>

			<div class="faq" id="f6">
				<h2>Soy una empresa</h2>
				<span>
					&iquest;Quieres registrarte en Gibeet y colaborar con una ONG? Completa el formulario de registro y ser&aacute;s contactado a la 
					brevedad por nosotros.
					<br/>
					Podr&aacute;s elegir entre diferentes Sue&ntilde;os de ONGs y ayudar, junto a tus empleados, a que se vuelvan realidad. <a href="registro" style="color:#99CCFF;font-weight:bold">&iexcl;Empieza ahora!</a> 
				</span>
			</div>

		<!--  Por que? -->
			<div class="faq" id="f7">
				<h2>Ventajas de la RSE 2.0</h2>
				<span>La Responsabilidad Social Empresaria es una actividad que crece d&iacute;a a d&iacute;a en el &aacute;mbito empresarial.</span>
				<span>Fortalece valores de la empresa.</span>
				<span>Contribuye a una valoraci&oacute;n positiva en la imagen de la empresa tanto para empleados como para clientes, consumidores y la opini&oacute;n p&uacute;blica.</span>
				<span>Posicionamiento en Mercado.</span>
				<span>Comportamiento &eacute;tico consistente.</span>
				<span>Sustentabilidad.</span>
				<span>Confianza a accionistas.</span>
				<span>Atracci&oacute;n de mejores talentos.</span>
				<span>Alinea a los empleados detr&aacute;s de un fin com&uacute;n y tan valioso como la solidaridad. Los fideliza.</span>
				<span>Contribuye a un buen clima laboral.</span>
				<span>No necesariamente una actividad solidaria es un gasto para la empresa.</span>
				<span>Reduce costos en caso de insertarse en la RSE medioambiental.</span>
				<span>A largo plazo, es redituable econ&oacute;micamente.</span>
			</div>
			
			<div class="faq" id="f8">
				<h2>Beneficios</h2>
				<span>Gibeet eleva estos beneficios a un nuevo nivel: el 2.0. </span>
				<span>
					Hablamos el mismo idioma que tus empleados, le sumamos creatividad e innovación y llevamos a cabo una nueva forma de Solidaridad.
					<br/>
					Una solidaridad participativa, motivante, interactiva y por sobre todas las cosas, necesaria tanto para la vida de tu empresa como la de
				 	tus empleados y de la ONG ayudada. 
				</span>
			</div>
			
			<div class="faq" id="f9">
				<h2>Nuestro valor</h2>
				<span>
					Formalizamos actividades RSE dándoles un marco creativo, original y amigable. <b>¡No es una terciarización!</b>
					<br/>
					Proponemos una RSE organizada y continuada. Ayudar, ¡siempre!
					<br/>
					Creamos un canal de comunicación directo entre los empleados y las personas ayudadas.  No es sólo en una ayuda de tipo monetaria (o no), sino que se genera un lazo más profundo. 
				</span>
			</div>


		<!-- Nuestros servicios -->
			<div class="faq" id="f10">
				<h2>¿Qué son las Colectas 2.0?</h2>
				<span>				
					Te ofrecemos la posibilidad de realizar Colectas de dinero online entre tus empleados y clientes. Velocidad, practicidad y 
					donaci&oacute;n instant&aacute;nea. ¡Todos para uno! 
					<br/><br/>
					Las colectas 2.0 son colectas que se realizan de forma online: se aporta, mediante transacciones online, peque&ntilde;as 
					cantidades dinero entre los empleados y/o clientes de la empresa para recaudar la cantidad de dinero que necesita la ONG.
					La donaci&oacute;n es instant&aacute;nea.
					<br/><br/>
					Detr&aacute;s de un objetivo com&uacute;n, fortalecemos el esp&iacute;ritu de unidad de los empleados. Apelamos al sentimiento, 
					conocimiento y empat&iacute;a profunda con el sue&ntilde;o a cumplir.
					<br/>
					Hacer colectas 2.0 es f&aacute;cil! S&oacute;lo tienes que buscar una ONG amiga y utilizar todas nuestras herramientas sociales para 
					difundir tus acciones RSE a todos tus empleados, clientes y/o proveedores. 
				</span>
			</div>
		
			<div class="faq" id="f11">
				<h2>¿Qué son las Donaciones 2.0?</h2>
				<span>
					Gibeet y tu empresa en intervenciones novedosas y creativas para conseguir donaciones materiales como nunca antes. 
					<br/>
					¿Est&aacute;s preparado para la acci&oacute;n? Se realiza una colecta de cualquier tipo de donaci&oacute;n no monetaria 
					requerida por la ONG. 
					Gibeet propone formas creativas e innovadoras para alcanzar el objetivo y los empleados, tienen no s&oacute;lo la posibilidad de 
					donar sino de participar activamente para conseguir las donaciones. 
					<br/><br/>
					Las Colectas Offline (o Donaciones 2.0), se llevar&aacute;n a cabo, por ejemplo, con intervenciones en la empresa, intervenciones 
					urbanas, y diferentes formas creativas para conseguirlas.
					<br/><br/>
					Para llevar a cabo una Colecta Offline tienes que tener una entidad amiga y luego completar un formulario con algunos datos.
					Luego, nos contactaremos contigo para ofrecerte las mejores alternativas. 
				</span>
			</div>
			
			<div class="faq" id="f12">
				<h2>¿Qué son los Eventos 2.0?</h2>
				<span>
					Tu empresa como protagonista de eventos solidarios totalmente innovadores. Nadie podr&aacute; olvidarlos. 
					<br/><br/>
					¡Qu&eacute; empiece la fiesta! 
					 Los eventos 2.0 son eventos solidarios no tradicionales de los cuales participar&aacute;n tanto personal de la empresa como 
					 representantes de la ONG. Desarrollamos y armamos eventos cortos pero creativos e inolvidables en los que se realizar&aacute; 
					 una acci&oacute;n solidaria espec&iacute;fica. 
					 <br/><br/>
					 Adem&aacute;s, realizamos una cobertura multimedia y online a trav&eacute;s de redes sociales.
					<br/>
					Al igual que cada acci&oacute;n realizada por Gibeet, los Eventos 2.0 fortalecer&aacute;n valores de la empresa y en consecuencia los 
					de los empleados. Contribuyen a una valoraci&oacute;n positiva en la imagen de la marca tanto para empleados como para clientes,
					 consumidores y la opini&oacute;n p&uacute;blica.
					<br/><br/>
					La clave de los Eventos 2.0 son su estilo creativo, innovador y no tradicional.
				</span>
			</div>					

		<!-- Costos -->
			<div class="faq" id="f13">
				<h2>Servicios</h2>
				<span>
					Gibeet tiene un paquete servicios y precios ideales para cada empresa. <a href="registro" style="color:#99CCFF">Desde aqu&iacute;</a> podr&aacute;s conocerlos.
					 ¡No dudes en consultarnos por cualquier motivo! 
				</span>
			</div>	
			
			<div class="faq" id="f14">
				<h2>MercadoPago</h2>
				<span>
					Es el sistema de transacciones y pagos de MercadoLibre y el cuál utilizamos para que los Soñadores y ONGs como tí reciban su dinero.
					Para que esto sea posible, es necesario que los datos de la cuenta de MercadoPago sean configuradas en tu perfil Gibeet.
					Todo el dinero recaudado será depositado en tu cuenta de MercadoPago para que puedas retirarlo cuando desees.		
					<br/>
					MercadoPago cobra una comisión del 5.99 % sobre el total recaudado (IVA incluido),
				</span>
			</div>			
		
		<!-- Seguridad y privacidad -->
			<div class="faq" id="f15">
				<h2>Seguridad y privacidad</h2>
				<span>
					Todo lo referente a las politicas de seguridad, privacidad, términos y condiciones se detallan a continuación.
				</span>
				<span>
					<iframe src="privacidad.php" style="width:680px; height:150px; border: 1px solid #CCCCCC; margin-bottom:20px;"></iframe>
					<iframe src="terminos.php" style="width:680px; height:150px; border: 1px solid #CCCCCC"></iframe>
				</span>
			</div>
			
		</div>
 
	</div>
	
</div>