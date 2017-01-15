<div class="modal-title">Difunde tu acci&oacute;n RSE</div>
<h3>Utiliza los distintos medios de contacto para que tus acciones RSE tengan el mayor alcance posible.</h3>

    <div id='fb-root'></div>
    <script>

		// Difusion via Facebook
		var logged = false;
		FB.init({
        	appId      : '236578669695749',
       		status     : true, 
       		cookie     : true,
       		xfbml      : true,
       		oauth      : true,
   		});
      		
		FB.getLoginStatus(function(response) {
			if (response.authResponse) {
				logged = true;
			} else {
				logged = false;
		   	}
		});
		
		function getStatus(status) {

		   FB.getLoginStatus(function(response) {
				if (response.authResponse) {
					var token = response.authResponse.accessToken;
					feed(token);
				} else {
					login();
			   	}
		   });
		}
		
		function login() {
		
		   FB.login(function (response) {
			    if (response.authResponse) {
			        var token = response.authResponse.accessToken;
			        feed(token);
			    } else {
			    	//getLoginStatusFB();
			    }
			});
		}
			
		function feed(token) {			
			
	        var obj = {
	          method: 'feed',
	          display: 'iframe',
			  access_token: token,
	          link: 'http://www.gibeet.com.ar/index.php?sk=<?php echo $_GET["entityusername"]?>&empresa=<?php echo $_GET["loggedUser"]?>',
	          picture: 'http://www.gibeet.com.ar/entities/<?php echo $_GET['entityusername']?>/<?php echo $_GET['entityusername']?>_1.jpg',
	          name: '¡Estamos ayudando!',
	          caption: 'Somos parte de la RSE 2.0, Conocé a <?php echo $_GET["entityname"]?>, la ONG a la que estamos ayudando utilizando Gibeet.',
	          description: 'Nosotros y  <?php echo $_GET["entityname"]?>, UNIDOS por un sueño. Entre todos estamos cumpliendo un sueño. ¿Querés ayudar vos también?'
	        };
	        function callback(response) {
	        	//alert("ok");
	        }

        	FB.ui(obj, callback);
		}

		// Difusion via Twitter
		$('#twitter-link').click(function(event) {
		    var width  = 650,
		        height = 270,
		        left   = ($(window).width()  - width)  / 2,
		        top    = ($(window).height() - height) / 2,
		        url    = this.href,
		        opts   = 'status=1' +
		                 ',width='  + width  +
		                 ',height=' + height +
		                 ',top='    + top    +
		                 ',left='   + left;
		    
		    window.open(url, 'twitter', opts);
		    return false;
		});

		// Difusion via Email
		function sendEmail() {

			if (!confirm('Estas por enviarle una notificacion a todos tus contactos via mail. Deseas continuar?')) { return; }

			$.fn.sendEmails();
		}
			    
    </script>
    
<div id="diffuseLoading" style="position:absolute; top:200px; left:365px; width:30px; height:30px;"></div>

<div style="margin-top:10px;margin-bottom:20px;overflow:hidden">
	<div style="overflow:hidden">
		<div class="diffuse-button-container" style="padding-left:40px;" onclick="javascript:if(!logged){login();}else{getStatus();}"><img src="images/diffuse-fb-button.png" /></div>
		<div class="diffuse-button-container">
			<a href="http://twitter.com/share?url=http://www.gibeet.com.ar/index.php?sk=<?php echo $_GET["entityusername"]?>&amp;empresa=<?php echo $_GET["loggedUser"]?>&text=Ya tenemos nuestra fundación amiga en Gibeet. ¡Conocela y ayudanos a ayudar!&via=gibeetcom&lang=es&hashtags=#RSE20 <?php echo $_GET["entityname"]?>" id="twitter-link"><img src="images/diffuse-tw-button.png" /></a>
		</div>
		<div class="diffuse-button-container" onclick="sendEmail()" id="diffuse-send-mail"><img src="images/diffuse-em-button.png" /></div>
		<div class="diffuse-button-container" id="diffuse-send-mail-ok" style="display:none"></div>
	</div>
	<div style="text-align:center;margin-top:15px">
		<input onclick="javascript:this.focus();this.select()" type="text" value="http://www.gibeet.com.ar/index.php?sk=<?php echo $_GET["entityusername"]?>&empresa=<?php echo $_GET["loggedUser"]?>" style="font-size:14px;width:450px;height:15px;color:#666666;text-align:center" />
		<h4 style="text-align:center;font-weight:normal">Comparte y difunde la direcci&oacute;n de <b><?php echo $_GET["entityname"]?></b> para que tus empleados y clientes puedan ayudar</h4>
	</div>
</div>

<center>
	<img src="images/silla4.jpg" />
</center>	