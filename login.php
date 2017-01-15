
	<?php 
	include_once 'model/User.class.php';
	include_once 'service/UserService.class.php';
	session_start();
	 
	// One time token
	$_SESSION["one-time-token"] = hash("sha256", time().KEY);
	$token = $_SESSION["one-time-token"];

	?>
		
	<h1>Ingresar</h1>
	<h3>
		Completa tus datos para ingresar. ¡Qu&eacute; bueno volver a verte!
	</h3>
	
	<div class="form" style="margin-left:130px">
	  <div class="inner">
	  	<form id="loginForm" onsubmit="return false" onkeypress="$.fn.callOnEnter(event, 'loginButton')">
	  	
			<label for="usuario">Usuario: </label>
			<input type="text" id="usuario" name="usuario" maxlength="<?php echo MAX_USUARIO; ?>" class="classic" />
			<br/>
			<label for="password">Contrase&ntilde;a: </label>
			<input type="password" id="password" name="password" class="classic" />
			<br/>
			
			<div style="padding-left:170px">
				<div class="forgot"><a href="registro">&iquest;No eres usuario?</a></div>
				<div class="forgot"><a id="forgotpassword" onclick="$.fn.showModal(this.id, 650, 250)">&iquest;Perdiste tu contrase&ntilde;a?</a></div>
			
				<div style="float:right;">
					<div id="login-loading" style="float:left;width:30px;height:30px"></div>
					<a onclick="$.fn.login('loginForm')" class="button" id="loginButton" style="float:right">Ingresar!</a>
				</div>
			</div>
		</form>
	  </div>
	</div>
