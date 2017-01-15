<?php 
	include_once 'config/constants.php';
?>



<div class="modal-title">Modifica tu perfil</div>

<!-- Profile image -->
<div style="float:left;">
	<div id="preview" class="preview-thumb">
		<img height="100" id="thumb" alt="No tienes ningun logo o imagen de perfil cargada">
	</div>
	<div class="preview-file">
		<form id="profileImageForm" class="form" style="margin-top:0px; margin-left:150px; background-color: transparent; border:none">
			<label for="usuario" style="font-size: 18px;">Selecciona tu logo: </label>
			<input type="file" size="20" id="profileImage" class="input-file" style="border: 1px solid #CCCCCC; height:30px">
		</form>
	</div>
</div>

<form id="perfilForm" class="form" onsubmit="return false" style="margin-left:150px; background-color: transparent; border:none">
	<label for="usuario">Usuario: </label><input type="text" id="usuario" name="usuario" maxlength="<?php echo MAX_NOMBRE; ?>" disabled="disabled" class="classic" /><br/>
	<label for="position">Puesto: </label><input type="text" id="position" name="position" maxlength="<?php echo MAX_PUESTO; ?>" class="classic" /><br/>
	<label for="name">Nombre / Empresa: </label><input type="text" id="name" name="name" maxlength="<?php echo MAX_NOMBRE; ?>" class="classic" /><br/>
	<label for="mail">Email: </label><input type="text" id="mail" name="mail" maxlength="<?php echo MAX_MAIL; ?>" class="classic" /><br/>
	<label for="birth">Nacimiento: </label><input type="text" id="birth" name="birth" maxlength="<?php echo MAX_BIRTH; ?>" class="classic" /><br/>
	<label for="country">Pa&iacute;s: </label>
		<select id="country" name="country" class="select-classic">
			<?php
				for ($i=0; $i < count($country_form_list); $i++) {
					$c = $country_form_list[$i];
			 ?>
					<option value="<?php echo $c?>" style="font-size:16px; color:#AAAAAA"><?php echo $c?></option>
			<?php 	
				} 
			?>
		</select>
		<br/>
	<label for="city">Ciudad: </label><input type="text" id="city" name="city" maxlength="<?php echo MAX_CITY; ?>" class="classic" /><br/>
	
	<div style="padding-right:40px">
		<div id="profile-loading" style="float:left; width:450px; padding-top:30px"></div>
		<a class="button" style="float:right;margin-top:10px" id="save-button" onclick="saveProfile()">Guardar</a>
	</div>
</form>

<script>
	var saved = true;

	function saveProfile() {

		if (!saved) {
			if(confirm("Estamos procesando la subida de tu imagen de perfil. Deseas cancelar la subida y continuar de todos modos?")) {
				$.fn.saveUserProfile();
			}
		} else {
			$.fn.saveUserProfile();
		}
	}
	
	$(document).ready(function() {
		
		$.fn.getUserProfile();

		// Date picker
		$( "#birth" ).datepicker({
			changeMonth: false,
			changeYear: true,
			yearRange: "1900:2000",
			dateFormat: "dd/mm/yy"
		});

		 uploadImage();
	});


	/**
		Upload image
	*/
	function uploadImage() {
		
		var thumb = $('#thumb');

		new AjaxUpload($('#profileImage'), {
				action: 'controller/user_save_image.php',
				name: 'profileImage',
				onSubmit: function(file, extension) {
					$('#preview').addClass('loading-div');
					saved = false;
				},
				onComplete: function(file, response) {

		   			var response = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test( response.replace(/"(\\.|[^"\\])*"/g, ' '))) && eval('(' + response + ')');
		   			if (response.success) {

						thumb.load(function(){
							$('#preview').removeClass('loading-div');
							thumb.unbind();
						});
						thumb.attr('src', 'images/profiles/' + response.msg);
						thumb.attr('alt', '');
			   		} else {
		   				$.fn.notification(response.msg, true);
		   			}

		   			saved = true;
				}
		});
	}
</script>
