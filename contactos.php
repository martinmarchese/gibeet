<script>
	function cancel() {
		$('#add-contacts-manually-container').show();
		$('#add-contacts-container').fadeIn();
		$('#contactsList').fadeOut();
		$('#save-contacts-button').fadeOut();
		$('#getContacts-button').show();
	}

	var idContacts = new Array();
	function mark2Delete(id) {
		var elem = $('#'+id);
		if (elem.css('text-decoration') == 'line-through') {
			elem.css('text-decoration','none');
			elem.css('font-weight','normal');
			idContacts[id] = null;
			return;
		}
		idContacts[id] = id;
		elem.css('text-decoration','line-through');
		elem.css('font-weight','bold');
	}

	var invalidEmails = new Array();
	function saveManuallyContacts() {
		
		var values = $('#contact-textarea').val();
		var valuesArr = values.split(";");
		var contacts = "";
		for (var i=0; i<valuesArr.length; i++) {
			var v = valuesArr[i];
			v = $.trim(v);
			if ($.fn.isMailStr(v)){
				contacts += 'contacts[]=|' + v + "&";
			} else {
				invalidEmails.push(v);
			}
		}

		if (invalidEmails.length > 0) {
			$('#invalidEmails-button').fadeIn();
		}
		
		$.fn.saveContacts(contacts);
	}

	function showInvalidMails() {

		var container = $('#invalidEmails-container');

		var html = "";
		for (var i=0; i<invalidEmails.length; i++){
			html += invalidEmails[i] + "<br/>";
		}
		container.html(html);

		$('.contact-invalid-email-container').fadeIn();
	}

	function hideInvalidMails() {
		$('.contact-invalid-email-container').fadeOut();
	}
	
	$(document).ready(function() {
		$.fn.getUserContacts();
	});
</script>

<div class="modal-title">Administra tus contactos</div>

<div id="contactsLoading" style="position:absolute; top:200px; left:365px; width:30px; height:30px;"></div>

<div style="float:left; width:380px; margin-right:30px; border-right: 1px solid #CCCCCC">

	<!-- Add contacts Gmail/Hotmail -->
	<div style="width:380px; float:left;">
		<h3>Agrega contactos nuevos.</h3>
		<span>Importa tus contactos desde la libreta de direcciones de Gmail.</span>
		<div id="add-contacts-container">
		  <form id="contactsForm" onsubmit="return false">
			<table>
				<tr>
					<td>Tu e-mail:</td>
					<td><input type="text" id="emailText" name="emailText" style="font-size:20px;height:25px; width:270px" maxlength="50" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" id="passwordEmailText" name="passwordEmailText" style="font-size:20px;height:25px; width:270px" maxlength="50" /></td>
				</tr>
				<tr>
					<td colspan="2" align="right" valign="middle">
						<div style="padding-top:10px; padding-left:50px; width:80px; float:left; text-align:left">
							<input type="radio" id="emailClientText" name="emailClientText" value="gmail" checked="checked"/><img src="images/gmail-icon.png"/> Gmail 
							<!-- <input type="radio" id="emailClientText" name="emailClientText" value="hotmail" /><img src="images/hotmail-icon.png"/> Hotmail -->
						</div>
						<a onclick="$.fn.getContacts()" class="button" id="getContacts-button" style="float:right">Obtener contactos</a>
					</td>
				</tr>
			</table>
		  </form>
		</div>
		<form id="saveContactsForm" onsubmit="return false">
			<div id="contactsList" style="display:none; height:300px; width:370px; overflow:auto"></div>
		</form>
		<div id="save-contacts-button" style="display:none;padding-right:10px;">
			<a onclick="$.fn.saveContacts()" class="link">Guardar contactos seleccionados</a>
			<a style="float:right" onclick="cancel()" class="link">Cancelar</a>
		</div>
	</div>
	
	<!-- Add contacts manually -->
	<div id="add-contacts-manually-container" style="width:380px; float:left; margin-top:20px;">
		<h3>Agregar contactos manualmente.</h3>
		<span>Ingresa aqu&iacute; los e-mails de los contactos que quieres agregar a tu lista. Si ingresas varios no olvides de separarlos con punto y coma<b>(";")</b></span>
		<textarea id="contact-textarea" name="contact-manually-text" rows="4" cols="40"></textarea>
		<a onclick="saveManuallyContacts()" class="link">Guardar contactos</a>
		<a onclick="showInvalidMails()" id="invalidEmails-button" style="display:none">Ver lista de email no inclu&iacute;dos</a>
	</div>
	
	<!-- Popup invalid emails -->
	<div class="contact-invalid-email-container" style="display:none;">
		<div>
			<h2>Email inv&aacute;lidos</h2>
			<br/><br/>
			<span>Los siguientes emails no fueron inclu&iacute;dos por ser inv&aacute;lidos.</span>
		</div>
		<div id="invalidEmails-container" style="margin-top:10px">
		</div>
		<div onclick="hideInvalidMails()" style="text-align:right;"><a>Cerrar</a></div>
	</div>

</div>


<!-- Your contacts -->
<div style="float:left; width:350px;">
	<h3>Tus contactos.</h3>
	<div style="height:342px; overflow:auto;">
		<div id="user-contacts-loading"></div>
		<ul class="contact-table" id="user-contacts"></ul>
	</div>
	<a onclick="$.fn.deleteUserContacts(idContacts)" class="link">Eliminar seleccionados</a>
</div>
