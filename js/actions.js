/**
 * User registration
 */
$.fn.registro = function(formId) {

	$.fn.clearInputErrors();
	
	var usuario = $('#registroForm #usuario');
	var nombre = $('#registroForm #nombre');
	var puesto = $('#registroForm #puesto');
	var mail = $('#registroForm #mail');
	var password = $('#registroForm #password');
	var password2 = $('#registroForm #password2');

	var valid = true;
	valid *= $.fn.isRequired(new Array(usuario, nombre, puesto, mail, password, password2));	
	valid *= $.fn.isMax(new Array(usuario, nombre, puesto, mail, password, password2));
	valid *= $.fn.isAlphanumeric(new Array(usuario, puesto, nombre, password, password2));
	valid *= $.fn.isMail(mail);
	valid *= $.fn.isEqual(password, password2);
	valid *= $.fn.isBetween(4, new Array(password, password2));

	var button = $('#registerButton');
	if (valid) {
		button.hide();
	}
	$.fn.send('user_register', formId, valid, null, 'register-loading', function(res){
		if (res.success) {
			location.href = "panel";
		} else {
			button.show();
		}
	});	
}


/**
 * User login
 */
$.fn.login = function(formId) {
	
	var usuario = $('#loginForm #usuario');
	var password = $('#loginForm #password');
	
	var valid = true;
	valid *= $.fn.isRequired(new Array(usuario));
	valid *= $.fn.isMax(new Array(usuario, password));
	valid *= $.fn.isAlphanumeric(new Array(usuario));
	
	var button = $('#loginButton');
	if (valid) {
		button.fadeOut();
	}
	$.fn.send('user_login', formId, valid, null, 'login-loading', function(res){
		if (res.success) {
			location.href = "panel";
		} else {
			button.fadeIn();
		}
	});
	
	return false; // to cancel form submittion
}


/**
 * Entity search
 */ 
$.fn.search = function(e) {
	var keynum = "";
	if(window.event) { // IE8 and earlier
		keynum = e.keyCode;
	} else if(e.which) { // IE9/Firefox/Chrome/Opera/Safari
		keynum = e.which;
	} 
	
	if (keynum == 13 || keynum == 1) {
		var search = $('#inputSearch');
		var valid = true;
		valid *= $.fn.isRequired(new Array(search));
		
		if (valid) {
			$('#entity-friend').hide();
			$('#search-results-content').hide();
			$('#search-results').show();
		}
		$.fn.simpleSend('entity_search', 'searchForm', valid, null, 'search-loading', function(res) {
				
			$.fn.notification(res.msg, false);
			
			if (res.success) {
			
				var html = "<ul class='thumb'>";
				for (var i=0; i<res.obj.length; i++) {
					var e = res.obj[i];
					html += "<a href='" + e["username"] + "'>";
					html += "<li>";
					html += "	<img src='entities/"+e["username"]+"/search.jpg' width='220' border='0' />";
					html += "	<div>";
					html += "		<h3>" + e["name"] + "</h3>";
					html += "		<span>" + e["description"] + "</span>";
					html += " 		<div class='add'>";
				    html += "			<img src='images/add-icon.png' height='30' />";
				    html += "		</div>";
					html += "	</div>";
					html += "</li>";
					html += "</a>";
				}
				html += "</ul>";
				$('#search-results-content').html(html);
				$('#search-results-content').fadeIn();
				
			} else {
				$('#search-results-content').html("<div class='search-no-results'>" + res.msg + "</div>");
				$('#search-results-content').fadeIn();
			}
		});
	}
}


/**
 * Get total money for a entity
 */
$.fn.getMoney = function(username) {
	
	$.fn.simpleSend('entity_money', null, true, 'username='+username, 'entity-money', function(res) {
		
		var money = 0;
		var collaborators = new Array();
		
		var resArray = res.split(',');
		if (resArray != null) {
			
			money = resArray[0];
			
			var colArr = resArray[1];
			if (colArr == null) { return; }
			
			colArr = colArr.split('|');
			for (var i=0; i<colArr.length; i++) {
				collaborators[colArr[i]] = colArr[i];
			}

			var chtml = "";
			for (c in collaborators) {
				chtml += collaborators[c] + "<br/>";
			}
		}
		 
		$('#entity-money').html(money);
		$('#entity-collaborators').html(chtml);
	});
}


/**
 * Add a friend entity
 */
$.fn.addFriendEntity = function(username) {

	$('#timeline-add-entity').fadeOut();
	
	$.fn.simpleSend('user_add_entity', null, true, 'username='+username, 'timeline-add-entity-loading', function(res) {

		if (res.success) {
			location.href = "panel";
		} else {
			$('#timeline-add-entity').fadeIn();
			if (res.msg) {
				$.fn.notification(res.msg, true);
			}
		}
	});
}


/**
 * Entity Unfriend
 */
$.fn.unfriend = function() {
	
	if (!confirm("Estas seguro que quieres terminar tus acciones RSE con este entidad?")) {
		return;
	}
	
	$.fn.simpleSend('user_delete_entity', null, true, null, 'panel-options-loading', function(res) {

		if (res.success) {
			location.href = "panel";
		} else {
			/*
			$('#timeline-add-entity').fadeIn();
			if (res.msg) {
				$.fn.notification(res.msg, true);
			}
			*/
		}
	});
}

/**
 * Gets the contacts of the user
 */
$.fn.getUserContacts = function() {

	$.fn.simpleSend('user_get_contacts', null, true, null, 'user-contacts-loading', function(res) {
		
		if (res.success) {
			var html = "";
			for (var i=0; i<res.obj.length; i++) {
				var e = res.obj[i];
				html += "<li id='" + e["id"] + "' onclick='mark2Delete(this.id)'>";
				html += "	<div class='name'>" + e["name"] + "</div>";
				html += "	<div class='email'>" + e["email"] + "</div>";
				html += "</li>";
			}
			if (res.obj.length == 0) {
				html = "<li><center>No tienes contactos almacenados</center></li>";
			}
			$('#user-contacts').html(html);
			
		} else {
			$('user-contacts').html("<li>No tiene contactos almacenados</li>");
		}
	});
	
}

/**
 * Gets contacts from email service
 */
$.fn.getContacts = function() {

	$('#getContacts-button').hide();
	
	var email = $('#contactsForm #emailText');
	var password = $('#contactsForm #passwordEmailText');
	var client = $('input[name=emailClientText]:checked', '#contactsForm');
	
	var valid = true;
	valid *= $.fn.isRequired(new Array(email, password));	
	valid *= $.fn.isMax(new Array(email, password));
	valid *= $.fn.isMail(email);
	if (client.val() == "") { valid *= 1;}
	
	if (valid == false) {	$('#getContacts-button').show();}

	$.fn.simpleSend('user_obtain_contacts', 'contactsForm', valid, null, 'contactsLoading', function(res) {
		
			if (res.success == false) {
				$('#getContacts-button').show();
				$.fn.notification(res.msg, true);
				return;
			}
			
			$('#add-contacts-manually-container').hide();
			$('#add-contacts-container').fadeOut();
			$('#contactsList').fadeIn();
			$('#save-contacts-button').fadeIn();
	
			var html = "";
			for (var key in res) {
				if (res.hasOwnProperty(key)) {
					html += "<div class='contact-items'>";
					html += "  <span style='float:left;width:25px;'><input type='checkbox' name='contacts[]' value='"+key+"|"+res[key]+"'/></span>";
					html += "  <span class='name'>"+res[key]+"</span><span class='email'>"+key+"</span>";
					html += "</div>";
				}
			}
			$('#contactsList').append(html);	
		}
	);
}

/**
 * Save contacts
 */
$.fn.saveContacts = function(contacts) {
	
	var form = 'saveContactsForm';
	var params = null;
	if (contacts != null) {		// Contacts are added manually
		params = contacts;
		form = null;
	}
	
	$.fn.send('user_save_contacts', form, true, params, 'contactsLoading', function(res) {

		if (res.success === true) {
			
			$.fn.getUserContacts();
			$('#contact-textarea').val("");
			$('#add-contacts-manually-container').show();
			$('#add-contacts-container').fadeIn();
			$('#contactsList').fadeOut();
			$('#save-contacts-button').fadeOut();
			$('#getContacts-button').show();
		}
	});

}

/**
 * Deletes the given user contacts
 */
$.fn.deleteUserContacts = function(contacts) {
	
	if (!confirm("Realmente quieres eliminar estos contactos?")) {
		return;
	}
	
	var queryString = "";
	for(c in contacts) {
		queryString += "ids[]=" + contacts[c] + "&"; 
	}
	
	$.fn.send('user_delete_contacts', null, true, queryString, 'contactsLoading', function(res) {

		if (res.success === true) {
			
			$.fn.getUserContacts();
		}
	});
}

/**
 * Gets user info
 */
$.fn.getUserProfile = function() {

	$.fn.simpleSend('user_get_profile', null, true, null, 'profile-loading', function(res) {

		if (res.success) {
			var u = res.obj;
			$('#thumb').attr('src', 'images/profiles/' + u["image"]);
			$('#usuario').val(u["username"]);
			$('#name').val(u["name"]);
			$('#mail').val(u["email"]);
			$('#birth').val(u["birth"]);
			$('#position').val(u["position"]);
			$('#country').val(u["country"]);
			$('#city').val(u["city"]);
		} else {
			$.fn.notification(res.msg, false);			
		}
	});	
}


/**
 * Saves user info
 */
$.fn.saveUserProfile = function() {

	var saveButton = $('#save-button');
	saveButton.hide();
	
	$.fn.clearInputErrors();
	
	var name = $('#perfilForm #name');
	var mail = $('#perfilForm #mail');
	var position = $('#perfilForm #position');
	var country = $('#perfilForm #country');
	var city = $('#perfilForm #city');

	var valid = true;
	valid *= $.fn.isRequired(new Array(name, mail));	
	valid *= $.fn.isMax(new Array(name, mail, position, country, city));
	valid *= $.fn.isAlphanumeric(new Array(name, position, country, city));
	valid *= $.fn.isMail(mail);

	if (!valid) { saveButton.show();}
	
	$.fn.send('user_save_profile', 'perfilForm', valid, null, 'profile-loading', function(res) {

		saveButton.show();
		
		$.fn.hideModal();
	});
}


/**
 * Share entity RSE via email
 */
$.fn.sendEmails = function() {
	
	$.fn.send('user_share_entity', null, true, null, 'diffuseLoading', function(res) {

		if (res.success === true) {
			var html = "<p><b>No olvides... tambi&eacute;n puedes difundir tu acci&oacute;n RSE a trav&eacute;s de otros medios!</b></p>" +
					   "<img src='images/back-arrow-icon.png' />";
			$('#diffuse-send-mail').hide();
			$('#diffuse-send-mail-ok').fadeIn();
			$('#diffuse-send-mail-ok').html(html);
		} 
	});	
}


/**
 * A prospect makes a contact
 */
$.fn.prospectContact = function() {
	
	var button = $('#send-button');
	button.fadeOut();
	
	$.fn.send('prospect_contact', 'prospectForm', true, null, 'send-loading', function(res) {

		if (res.success === true) {
			var html = "<p><b style=\"color:green\">Hemos recibido el formulario con tus datos!</b> <br><br>A la brevedad, un miembro del equipo se estar&aacute; comunicando contigo a la direcci&oacute;n de email que figura en tu perfil.</b></p>" +
					   "<img class=\"link\" onclick=\"$.fn.hideModal()\" src=\"images/back-arrow-icon.png\">";
			$('#send-container').hide();
			$('#prospectForm').hide();
			$('#modal-title').hide();
			
			$('#send-confirmation').html(html);
		} else {
			button.fadeIn();
		}
	});
}


/**
 * Send forgot password code
 */
$.fn.sendPassword = function() {
	
	$('#send-button').hide();
	
	var usuario = $('#username');
	
	var valid = true;
	valid *= $.fn.isRequired(new Array(usuario));	
	valid *= $.fn.isMax(new Array(usuario));
	
	if (!valid) { $('#send-button').show();}
	
	$.fn.send('user_send_password', null, valid, "usuario="+usuario.val(), 'send-loading', function(res) {
		
		if (res.success === true) {

		} else {
			
			$('#send-button').show();
		}
	});
}

/**
 * Creates the new password
 */
$.fn.retrievePassword = function() {
	
	$.fn.clearInputErrors();

	$('#retrieve-button').hide();
	
	var password = $('#retrievePasswordForm #password');
	var password2 = $('#retrievePasswordForm #password2');

	var valid = true;
	valid *= $.fn.isRequired(new Array(password, password2));	
	valid *= $.fn.isMax(new Array(password, password2));
	valid *= $.fn.isAlphanumeric(new Array(password, password2));
	valid *= $.fn.isEqual(password, password2);
	valid *= $.fn.isBetween(4, new Array(password, password2));
	
	if (!valid) { $('#retrieve-button').show(); }

	$.fn.send('user_save_password', 'retrievePasswordForm', valid, null, 'retrieve-loading', function(res){
		
		if (res.success) {
			location.href = "panel";
		} else {
			$('#retrieve-button').show();
		}
	});	
}