	<!-- div class="form" style="margin-left:130px">
	  <div class="inner">
	  	<form id="registroForm" onsubmit="return false" onkeypress="$.fn.callOnEnter(event, 'registerButton')">
	  		<input type="hidden" id="token" name="token" value="<?php echo $token;?>" />
			<label for="usuario">Usuario: </label><input type="text" id="usuario" name="usuario" maxlength="<?php echo MAX_USUARIO; ?>" class="classic" /><br/>
			<label for="nombre">Nombre / Empresa: </label><input type="text" id="nombre" name="nombre" maxlength="<?php echo MAX_NOMBRE; ?>" class="classic" /><br/>
			<label for="puesto">Puesto: </label><input type="text" id="puesto" name="puesto" maxlength="<?php echo MAX_PUESTO; ?>" class="classic" /><br/>
			<label for="mail">Email: </label><input type="text" id="mail" name="mail" maxlength="<?php echo MAX_MAIL; ?>" class="classic" /><br/>
			<label for="password">Contrase&ntilde;a: </label><input type="password" id="password" name="password" maxlength="<?php echo MAX_PASSWORD; ?>" class="classic" /><br/>
			<label for="password2">Repite contrase&ntilde;a: </label><input type="password" id="password2" name="password2" maxlength="<?php echo MAX_PASSWORD; ?>" class="classic" />
		
			<div style="padding-left:200px;margin-top:10px">
				<div class="forgot"><a href="login">&iquest;Ya eres un usuario registrado?</a></div>
				<div style="float:right; margin-left:15px;">
					<div id="register-loading" style="float:left;width:30px;height:30px"></div>
					<a class="button" onclick="$.fn.registro('registroForm')" id="registerButton">Registrarme!</a>
				</div>
			</div>
		</form>
	  </div>
	</div-->