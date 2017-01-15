
<div class="modal-title">&iquest;Has perdido tu contrase&ntilde;a?</div>

<div id="modal-content">

	<h1 class="modal-subtitle">
		Completa tu nombre de usuario y te enviaremos a tu casilla de email los pasos a seguir para recuperar tu contrase&ntilde;a!
	</h1>

	<div style="float:left; width:530px; margin-top:25px; padding-left:40px;">
		<form id="forgotPasswordForm" onsubmit="return false">
			<label for="usuario" style="font-size:16px">Usuario:&nbsp;&nbsp; </label>
			<input type="text" id="username" name="username" maxlength="<?php echo MAX_USUARIO; ?>" class="classic" />
			<a onclick="$.fn.sendPassword()" id="send-button" class="button" style="float:right;font-size:14px;height:25px;width:70px;margin-top:2px;padding-top:10px">Enviar!</a>
			<div id="send-loading"></div>
		</form>
	</div>		
</div>
