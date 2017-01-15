<?php
?>
<script>
function validateRetrievePassword(){
	if (isNotNull('passwordText') && isNotNull('passwordText2') &&
		min6max20('passwordText') && isEqual('passwordText','passwordText2')
		){
		return true;
	}
	return false;
}
function retrievePassword() {
	if (!validateRetrievePassword()){return false;}
	showLoading('loadingRetrievePassword');
	$.ajax({
   		type: "POST",
   		url:  "controller/LoginController.php",
   		data: getFormQueryString("retrievePasswordForm"),
   		success: successRetrievePassword
 	});
}
function successRetrievePassword(res) {
	var response = eval("("+res+")");
	var msg = document.getElementById("messagesRetrievePassword");

	if (response.success){
		setOkMsg(msg,response.success);
		$('#retrievePasswordDiv').fadeOut();
	} else{
		setKoMsg(msg,response.failure);
	}
	hideLoading('loadingRetrievePassword');
}
</script>



		
<h1>Recupero de contrase&ntilde;a</h1>
<h3>Por favor ingres&aacute; tu nueva contrase&ntilde;a</h3>

<div class="form" style="margin-left:130px">
  <div class="inner">
  	<form id="retrievePasswordForm" onsubmit="return false">
		<input type="hidden" id="code" name="code" value="<?php echo $_REQUEST['code'];?>" />
		
		<label for="">Nueva contraseña: </label>
		<input type="password" id="password" name="password" maxlength="<?php echo MAX_PASSWORD; ?>" class="classic" />
		<br/>
		<label for="">Reescribe la contrase&ntilde;a: </label>
		<input type="password" id="password2" name="password2" maxlength="<?php echo MAX_PASSWORD; ?>" class="classic" />
		<br/>
		<div id="retrieve-loading"></div>
		<a onclick="$.fn.retrievePassword()" id="retrieve-button" class="button" style="float:right">Guardar</a>
	</form>
  </div>
</div>
