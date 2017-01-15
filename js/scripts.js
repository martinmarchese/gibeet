
// slider initialization
$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "fade",
		slideDirection: "horizontal",
		slideshow: true,
		slideshowSpeed: 3500,
		animationDuration: 500
	});
});

// notification initialization
$.pnotify.defaults.styling = "jqueryui";
$.pnotify.defaults.history = false;
$.fn.notification = function(text, error) {
	
	$.pnotify_remove_all();
	
	var type = "success";
	if (error) { type = "error"; }
	
	$.pnotify({
		title: text,
		type: type,
		sticker: false,
		stack: false,
        addclass: "stack-bar-top",
        cornerclass: "",
        width: "98%",
    		before_open: function(pnotify) {
    			pnotify.css({
    				left: '10px',
    				top: '0px'
    			});
    		}
	});
}


// tooltip initialization
var panelTooltip;
$.fn.initilizeTooltip = function(text) {
	
	panelTooltip = $.pnotify({
		text: text,
		hide: false,
		closer: false,
		sticker: false,
		history: false,
		animate_speed: 100,
		opacity: 0.9,
		stack: false,
		after_init: function(pnotify) {
						pnotify.mouseout(function() {
						pnotify.pnotify_remove();
					});
		},
		before_open: function(pnotify) {
						pnotify.pnotify({
							before_open: null
						});
						return false;
					}
	});
}
$.fn.initilizeTooltip();


// modal dialog initialization
$.fn.showModal = function(id, width, height, params) {
	var opts = {
				type		: 'ajax',
				href		: (params) ? id+'.php?' + params : id+'.php',
				maxWidth	: (width) ? width : 800,
				maxHeight	: (height) ? height : 420,
				fitToView	: false,
				width		: '70%',
			
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			   } 
	if ($('#'+id).size() < 1) {
		$.fancybox(opts);
		return;
	}
	$('#'+id).fancybox(opts);
	
}
$.fn.hideModal = function() {
	$.fancybox.close();
}


$.fn.callOnEnter = function(e, elem) {
	
	if ($.fn.isEnterPressed(e)) {
		$.fn.clickOnEnter(elem);
	}
}

/**
 * Detects if user pressed enter key
 */
$.fn.isEnterPressed = function(e) {
	var keynum = "";
	if(window.event) { // IE8 and earlier
		keynum = e.keyCode;
	} else if(e.which) { // IE9/Firefox/Chrome/Opera/Safari
		keynum = e.which;
	} 
	
	if (keynum == 13 || keynum == 1) {
		return true;
	}
	return false;
}

/**
 * Makes a click event on enter key pressed
 */
$.fn.clickOnEnter = function(id) {
	
	$('#'+id).click();
}


/**
 * Show Menu Panel Tooltip
 */
$.fn.showPanelTooltip = function(type) {
	
	var text = "";
	switch (type) {
    	case "edit":
    		text = "Modifica tu perfil";
    		break;
        case "contact":
    		text = "Administra tus contactos";
    		break;        	
        case "diffuse":
        	text = "Difunde a todos tus contactos tu acci&oacute;n con la entidad amiga ";
        	break;
        case "help":
        	text = "Aprende a usar Gibeet";
        	break;        	
        case "cancel":
        	text = "Finalizar acci&oacute;n con esta entidad";
        	break;
        case "add-entity":
        	text = "Haz tu acci&oacute;n RSE con esta entidad";
        	break;
        case "entityfriend":
        	text = "Visita la p&aacute;gina de tu entidad amiga";
        	break;
	}
	$.fn.initilizeTooltip(text);
	panelTooltip.pnotify_display();
}

/**
 * Shows a tooltip with the given text
 */
$.fn.showPanelTooltipText = function(text) {
	$.fn.initilizeTooltip(text);
	panelTooltip.pnotify_display();
}

/**
 * Page redirect
 */
$.fn.redirect = function(page) {
	location.href = page;
}


/**
 * Gets queryString for a given form
 */
$.fn.getFormQueryString = function (formId) {
	
	if (formId == null) { return; }
	
	var formElement = document.getElementById(formId);
	
	var queryString = "";
	for (var i=0; i < formElement.elements.length; i++){		
		var element = formElement.elements[i];
		if (element.type == "password" || element.type == "hidden" || element.type == "button" || element.type == "text" || element.type == "select-one" || element.type == "textarea" || (element.type == "checkbox" && element.checked)|| (element.type == "radio" && element.checked) ){			
			queryString += element.name+"="+element.value+"&";
		}
	}
	return queryString;
}

/**
 * Converts an object to a single array
 */
$.fn.obj2Array = function(elem) {
	if (elem instanceof Array == false) {	
		var bkp = new Array;
		bkp[0] = elem;
		elem = bkp;
	}
	return elem;
}

/**
 * Show loading div
 */
$.fn.showLoading = function(id) {
	if (id !=null) {
		document.getElementById(id).className = 'loading-div';
		document.getElementById(id).innerHTML = "&nbsp";
	}
}
/**
 * Hide loading div
 */
$.fn.hideLoading = function(id) {
	if (id !=null) {
		document.getElementById(id).className = '';
	}
}

/**
 * Makes an Ajax call
 */
$.fn.send = function(to, formId, valid, extra_params, loading, callback) {
	
	$.fn.showLoading(loading);
	if (valid == false || valid == 0) {
		$.fn.hideLoading(loading);
		return false; 
	}

	$.ajax({
   		type: "POST",
   		url:  "controller/"+to+".php",
   		data: $.fn.getFormQueryString(formId)+"&"+extra_params,
   		success: function(res) {

   			$.fn.hideLoading(loading);
   			var response = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test( res.replace(/"(\\.|[^"\\])*"/g, ' '))) && eval('(' + res + ')');
   			if (response.success) {
   				$.fn.notification(response.msg, false);
   			} else {
   				$.fn.notification(response.msg, true);
   			}
   			if (callback != null) {
   				callback(response);
   			}
   		},
   		error: function() {
   			$.fn.showLoading(loading);
   			$.fn.notification("Opss! Tuvimos un inconveniente al acceder a tu informacion. Por favor intenta de nuevo. Muchas gracias!", true);
   		}
 	});	

}

/**
 * Makes a simple Ajax call
 */
$.fn.simpleSend = function(to, formId, valid, extra_params, loading, callback) {
	
	$.fn.showLoading(loading);
	if (valid == false || valid == 0) { 
		$.fn.hideLoading(loading);
		return false; 
	}
	$.ajax({
   		type: "POST",
   		url:  "controller/"+to+".php",
   		data: $.fn.getFormQueryString(formId)+"&"+extra_params,
   		success: function(res) {

   			$.fn.hideLoading(loading);
   			var response = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test( res.replace(/"(\\.|[^"\\])*"/g, ' '))) && eval('(' + res + ')');
   			if (callback != null) {
   				callback(response);
   			}
   		}
 	});	
}

/**
 * Makes a redirect into a modal window
 */
$.fn.modalRedirect = function(page) {
	
	var modal = $('#modal-content');
	var id = modal.attr('id');
	
	$.fn.showLoading(id);
	$.ajax({
		url: page,
	}).done(function(html) { 
		modal.html(html);
		$.fn.hideLoading(id);
	});
}


/**
 * Toggles an input value
 */
$.fn.toggleInput = function(original) {
	var value = $(this).val();
	
	if (value == original) {
		$(this).val("");
	}
	if (value == "") {
		$(this).val(original);
	}
}


/**************************************************************************************
 * Validations
 **************************************************************************************/
var inputError = new Array();
$.fn.clearInputErrors = function() {
	$.pnotify_remove_all();
	inputError = new Array();
}
$.fn.showInputError = function(elem, msg) {
	
	var elemId = elem.attr('id') + 'Error';
	if (inputError[elemId] != null) {
		return;
	}
	inputError[elemId] = $.pnotify({
		id: elemId,
		text: msg,
		type: 'error',
		sticker: false,
		stack: false,
		opacity: .8,
    	before_open: function(pnotify) {
    		pnotify.css({
    			position: 'absolute',
    			left: elem.offset().left + elem.width() - 60,
    			top: elem.offset().top
    		});
    	},
		after_close: function(pnotify) {
			inputError[elemId] = null;
		}
		
	});
}
$.fn.isRequired = function(elem) {
	var valid = true;	
	
	elem = $.fn.obj2Array(elem);
	for (var i=0;  i<elem.length; i++) {
		var value = elem[i].val();
		if (value == null || value == "") {
			$.fn.showInputError(elem[i], 'Este campo es obligatorio');
			valid = false;
		}
	}
	return valid;
}
$.fn.isMax = function(elem) {
	var valid = true;
	
	elem = $.fn.obj2Array(elem);
	for (var i=0; i<elem.length; i++) {	
		var value = elem[i].val();
		value = value.trim();
		var max = elem[i].attr('maxlength')
		
		if (value.length > max) {
			$.fn.showInputError(elem[i], 'El tama&ntilde;o m&aacute;ximo es de ' + max + ' caracteres!');
			valid = false;
		}
	}
	return valid;
}
$.fn.isAlphanumeric = function(elem) {
	var valid = true;
	var reg = /^[0-9a-zA-Z ]+$/;
	
	elem = $.fn.obj2Array(elem);
	for (var i=0; i<elem.length; i++) {	
		if (!elem[i].val().match(reg)){
			$.fn.showInputError(elem[i], 'S&oacute;lo permitimos n&uacute;meros y letras!');
			valid = false;
		}
	}
	return valid;
}
$.fn.isMailStr = function(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if (email == '' || !re.test(email)) {
		return false;
	} 
	return true;	
}

$.fn.isMail = function(elem) {
	var email = elem.val();
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;	
	if (email == '' || !re.test(email)) {
		$.fn.showInputError(elem, 'El email que has ingresado no es v&aacute;lido!');
		return false;
	} 
	return true;
}
$.fn.isEqual = function(elem1, elem2) {
	if (elem1.val() != elem2.val()){
		var msg = 'Las contrase&ntilde;as no coinciden!';
		$.fn.showInputError(elem1, msg);
		$.fn.showInputError(elem2, msg);
		return false;
	}
	return true;
}
$.fn.isBetween = function(min, elem) {
	var valid = true;	
	elem = $.fn.obj2Array(elem);
	for (var i=0; i<elem.length; i++) {	
		if (elem[i].val().length < min || elem[i].val().length > elem[i].attr('maxlength')){
			$.fn.showInputError(elem[i], 'La contrase&ntilde;a debe tener entre '+min+' y '+elem[i].attr('maxlength')+' caracteres');
			valid = false;
		}
	}
	return valid;
}


function onlyNumber(e, obj) {
	var sKey = -1;
	var bResult = true;
	var bPunto = (obj.value.indexOf(".") != -1);
	var lCantChars = obj.value.length;
	if (window.event){
		sKey = e.keyCode;
	}else if (e.which){
		sKey = e.which;
	}
	if (sKey > 10){
		if (((sKey < 48 || sKey > 57) && (sKey != 46 || bPunto)) || (!bPunto && lCantChars > 6 && sKey != 46)){
			bResult = false;
		}
	}
	return bResult;
}


// Format to money number
function doFormat(oText){
	var aDec = oText.value.split('.');
	if(aDec.length > 1) {
		if(aDec[1].length == 1) {
			oText.value = aDec[0] + '.' + aDec[1].split('.')[0] + '0';
		}
		if(aDec[1].length == 0) {
			oText.value = aDec[0] + '.00';
		}
		if(aDec[1].length >= 2) {
			oText.value = aDec[0] + '.' + aDec[1].substr(0,2);
		}
	} else {
		oText.value = aDec + '.00';
	}
}