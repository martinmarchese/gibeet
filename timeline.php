<?php
session_start();
//include_once 'model/EntityCheckout.class.php';
//include_once 'service/CheckoutService.class.php';
	
function highlight_text($text) {
	
	$words = explode(" ", $text);
	$highlight_html = "<b style=\"color:#f79234\">";
	for ($i=0; $i<6; $i++) {
		$highlight_text .= $words[$i]." ";
	}
	$text = substr($text, strlen($highlight_text), strlen($text));
	return $highlight_html.$highlight_text."</b>".$text;
}

function highlight_keywords($keywords) {
	
	$keywords = explode(",", $keywords);
	$count = count($keywords);
	
	for ($i=0; $i<3; $i++) {
		$k = rand(0, $count);
		$keywords[$k] = "<span class=\"l\">".$keywords[$k]."</span>";
	}
	for ($i=0; $i<3; $i++) {
		$k = rand(0, $count);
		$keywords[$k] = "<span class=\"m\">".$keywords[$k]."</span>";
	}	
	return implode($keywords);
}

function map_url($address) {
	return str_ireplace(" " , "+", $address);
}

//function getCheckoutPreferences($username) {
//	$checkoutService = new CheckoutService();
//	$prefs = $checkoutService->getByUsername($username);
//	return $prefs;
//}

// main() 
//$username = "prueba";
//$prefs = getCheckoutPreferences($username);		// Gets the checkout preferences for the entity

if (isLogged()) { 	// Gets the payer info if the user is logged
	$name = $loggedUser->name;
	$email = $loggedUser->email;
	$friendEntity = $loggedUser->friend_entity;
}
?>

<script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>
<script>

$(document).ready(function() {
	$(window).scroll(function () { 
		if (window.scrollY > 400) {
			$('#timeline-menu').css('top', (window.scrollY - 400) + 'px');
		} else {
			$('#timeline-menu').css('top', 10);
		}
	});

	$.fn.getMoney('<?php echo $username?>');

	$("a.gallery").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});

function send_money_callback(json) {
	var width = 500;
	var height = 170;
	if (json.collection_status=='approved'){
		$.fn.showModal('checkoutok', width, height);
		
	} else if(json.collection_status=='pending'){
		$.fn.showModal('checkoutok', width, height);
		
	} else if(json.collection_status=='in_process'){
		$.fn.showModal('checkoutok', width, height);
		
	} else if(json.collection_status=='rejected'){
		$.fn.showModal('checkoutrejected', width, height);
		
	} else if(json.collection_status==null){
		$.fn.showModal('checkoutabandoned', width, height);
	}
}
</script>

<script type="text/javascript">
    (function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
    s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
    var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
    window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
</script>

	<!-- Header -->
	<div class="timeline-header" style="background: url('entities/<?php echo $entity->username;?>/timeline.jpg') no-repeat scroll center 0 transparent;">
		<div style="width:960px;margin:auto;padding-left:30px;padding-top:30px; position:relative">
		
			<!-- Nombre entidad -->
			<h1 class="title"><?php echo $entity->name; ?></h1>

			<!-- Agregar entidad amiga -->
			<div id="timeline-add-entity-loading"></div>
			
			<?php if (isLogged()) { ?>
			
				<?php if ($friendEntity == null) { ?>
		    		<div id="timeline-add-entity" class="timeline-add-entity" onmouseover="$.fn.showPanelTooltip('add-entity')" 
																			  onmouseout="panelTooltip.pnotify_remove();"
																			  onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" >
		    			<img src="images/add-icon.png" onclick="$.fn.addFriendEntity('<?php echo $username; ?>')" />
					</div>
				<?php } else if ($entity->username == $friendEntity) { ?>
					<img src="images/star-icon.png" style="float:left" height="20">
					<span class="timeline-add-entity-notification">
						Esta entidad YA es amiga tuya
					</span>	
				<?php } else if ($friendEntity != null) { ?>
					<img src="images/info-icon.png" style="float:left" height="20">
					<span class="timeline-add-entity-notification">
						Ya tienes una entidad amiga asociada. <br/>
						Para hacer de &eacute;sta entidad tu amiga, debes finalizar tu actual acci&oacute;n RSE.
					</span>		
				<?php } ?>
				
			<?php } else { ?>
		    		<div id="timeline-add-entity" class="timeline-add-entity" onmouseover="$.fn.showPanelTooltip('add-entity')" 
																			  onmouseout="panelTooltip.pnotify_remove();"
																			  onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" >
		    			<img src="images/add-icon.png" onclick="$.fn.redirect('login')" />
					</div>
			<?php } ?>
		</div>
	</div>
		
	<div id="content" style="margin-top:25px; position:relative">
	
			<!-- Menu -->
			<ul id="timeline-menu" class="timeline-options">
				<li onclick="$.scrollTo('#entity', 1000)">La entidad</li>
				<li onclick="$.scrollTo('#help', 1000)">Necesitamos</li>
				<li onclick="$.scrollTo('#gallery', 1000)">Galer&iacute;a</li>
				<li onclick="$.scrollTo('#location', 1000)">Videos</li>
				<li onclick="$.scrollTo('#video', 1000)">Ubicaci&oacute;n</li>
				<li onclick="$.scrollTo('#social', 1000)">Social</li>
			</ul>
			
			<div class="timeline-money">
				<h2>Ya recaudamos</h2>
				<h1>$<span id="entity-money"></span></h1>
				<br/><br/>
				
				<span><strong>Colabora con ...</strong></span><br/>

				<!-- $5 -->
				<form action="https://www.mercadopago.com/checkout/init" method="post" enctype="application/x-www-form-urlencoded" target="">
				    <input type="hidden" name="client_id" value="3619"/>
				    <input type="hidden" name="md5" value="<?php echo md5('3619'.'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn'.'1'.'ARS'.'5'.'1000'.$empresa);?>"/>

				    <input type="hidden" name="item_title" value="<?php echo $entity->username?>"/>
				    <input type="hidden" name="item_quantity" value="1"/>
				    <input type="hidden" name="item_currency_id" value="ARS"/>
				    <input type="hidden" name="item_unit_price" value="5"/>
				    <input type="hidden" name="item_id" value="1000"/>
				    
				    <input type="hidden" name="external_reference" value="<?php echo $empresa?>"/>
				    <input type="hidden" name="payer_name" value="<?php $username?>"/>
				     
				    <button type="submit" class="button-buy" name="MP-Checkout" onreturn="send_money_callback">$5</button>
				</form>

				<!-- $10 -->
				<form action="https://www.mercadopago.com/checkout/init" method="post" enctype="application/x-www-form-urlencoded" target="">
				    <input type="hidden" name="client_id" value="3619"/>
				    <input type="hidden" name="md5" value="<?php echo md5('3619'.'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn'.'1'.'ARS'.'10'.'1000'.$empresa);?>"/>

				    <input type="hidden" name="item_title" value="<?php echo $entity->username?>"/>
				    <input type="hidden" name="item_quantity" value="1"/>
				    <input type="hidden" name="item_currency_id" value="ARS"/>
				    <input type="hidden" name="item_unit_price" value="10"/>
				    <input type="hidden" name="item_id" value="1000"/>

				    <input type="hidden" name="external_reference" value="<?php echo $empresa?>"/>
				    <input type="hidden" name="payer_name" value="<?php $username?>"/>
				     
				    <button type="submit" class="button-buy" name="MP-Checkout" onreturn="send_money_callback">$10</button>
				</form>

				<!-- $20 -->
				<form action="https://www.mercadopago.com/checkout/init" method="post" enctype="application/x-www-form-urlencoded" target="">
				    <input type="hidden" name="client_id" value="3619"/>
				    <input type="hidden" name="md5" value="<?php echo md5('3619'.'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn'.'1'.'ARS'.'20'.'1000'.$empresa);?>"/>

				    <input type="hidden" name="item_title" value="<?php echo $entity->username?>"/>
				    <input type="hidden" name="item_quantity" value="1"/>
				    <input type="hidden" name="item_currency_id" value="ARS"/>
				    <input type="hidden" name="item_unit_price" value="20"/>
				    <input type="hidden" name="item_id" value="1000"/>

				    <input type="hidden" name="external_reference" value="<?php echo $empresa?>"/>
				    <input type="hidden" name="payer_name" value="<?php $username?>"/>
				     
				    <button type="submit" class="button-buy" name="MP-Checkout" onreturn="send_money_callback">$20</button>
				</form>

				<!-- $50 -->
				<form action="https://www.mercadopago.com/checkout/init" method="post" enctype="application/x-www-form-urlencoded" target="">
				    <input type="hidden" name="client_id" value="3619"/>
				    <input type="hidden" name="md5" value="<?php echo md5('3619'.'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn'.'1'.'ARS'.'50'.'1000'.$empresa);?>"/>

				    <input type="hidden" name="item_title" value="<?php echo $entity->username?>"/>
				    <input type="hidden" name="item_quantity" value="1"/>
				    <input type="hidden" name="item_currency_id" value="ARS"/>
				    <input type="hidden" name="item_unit_price" value="50"/>
				    <input type="hidden" name="item_id" value="1000"/>

				    <input type="hidden" name="external_reference" value="<?php echo $empresa?>"/>
				    <input type="hidden" name="payer_name" value="<?php $username?>"/>
				     
				    <button type="submit" class="button-buy" name="MP-Checkout" onreturn="send_money_callback">$50</button>
				</form>				
				
				<!-- $100 -->
				<form action="https://www.mercadopago.com/checkout/init" method="post" enctype="application/x-www-form-urlencoded" target="">
				    <input type="hidden" name="client_id" value="3619"/>
				    <input type="hidden" name="md5" value="<?php echo md5('3619'.'AqGS7fyZ09USqqMQpjmryqg0otL6zyfn'.'1'.'ARS'.'100'.'1000'.$empresa);?>"/>

				    <input type="hidden" name="item_title" value="<?php echo $entity->username?>"/>
				    <input type="hidden" name="item_quantity" value="1"/>
				    <input type="hidden" name="item_currency_id" value="ARS"/>
				    <input type="hidden" name="item_unit_price" value="100"/>
				    <input type="hidden" name="item_id" value="1000"/>

				    <input type="hidden" name="external_reference" value="<?php echo $empresa?>"/>
				    <input type="hidden" name="payer_name" value="<?php $username?>"/>
				     
				    <button type="submit" class="button-buy" name="MP-Checkout" onreturn="send_money_callback">$100</button>
				</form>				
				
				<!-- 
				 <span><b>... y obt&eacute;n tu <br/> certificado de alegr&iacute;a!</b></span><br/>
				-->											
				
				<h2 style="margin-top:60px;margin-bottom:20px">Apadrinan ...</h2>
				<?php if ( $entity->username == "inundaciones" ) { ?>
				<div>
					<div style="margin-top:25px; width:180px">
						<a href="http://www.braintive.com">
							<img src="images/profiles/braintive-logo.png" height="30" />
						</a>
					</div>
					<div style="margin-top:25px; width:180px">
						<a href="http://www.identicum.com">
							<img src="images/profiles/identicum-logo.png" height="40" />
						</a>
					</div>
					<div style="margin-top:25px; width:180px">
						<a href="http://www.vostu.com">
							<img src="images/profiles/vostu-logo.gif" height="40" />
						</a>
					</div>
				</div>
				<?php } ?>				
				<div id="entity-collaborators" style="font-style:italic;font-size:14px"></div>
			</div>
							

			<div class="timeline-content">
			
				<div id="entity">
					<?php echo highlight_text($entity->description); ?>
				</div>
				
				<div id="help">
					<?php echo highlight_keywords($entity->keywords)?>
				</div>
							
				<div id="gallery">
					<div><h1 style="text-align:left">Galer&iacute;a de fotos.</h1></div>
					<div><a class="gallery" rel="gallery" href="entities/<?php echo $username."/".$username ?>_1.jpg"><img src="entities/<?php echo $username."/".$username ?>_thumb_1.jpg" height="150"></a></div>
					<div><a class="gallery" rel="gallery" href="entities/<?php echo $username."/".$username ?>_2.jpg"><img src="entities/<?php echo $username."/".$username ?>_thumb_2.jpg" height="150"></a></div>
					<div><a class="gallery" rel="gallery" href="entities/<?php echo $username."/".$username ?>_3.jpg"><img src="entities/<?php echo $username."/".$username ?>_thumb_3.jpg" height="150"></a></div>
					<div><a class="gallery" rel="gallery" href="entities/<?php echo $username."/".$username ?>_4.jpg"><img src="entities/<?php echo $username."/".$username ?>_thumb_4.jpg" height="150"></a></div>
					<div></div>
				</div>
				
				<div id="video">
					<h1>Video.</h1>
					<iframe width="620" height="320" src="<?php echo $entity->youtube?>" frameborder="0" allowfullscreen></iframe>
				</div>
				
				<div id="location">				
					<div><img src="http://maps.google.com/maps/api/staticmap?size=280x200&maptype=roadmap&zoom=14&markers=size:mid%7Ccolor:red%7C<?php echo map_url($entity->address)?>&sensor=false"/></div>
					<div style="padding-left: 10px;"><h1>Donde <br/>estamos.</h1></div>
					<div style="padding-left: 10px; width:300px"><span><?php echo $entity->address ?></span></div>
				</div>

				<div id="social" style="margin-bottom:30px">
					<div style="margin-left:20px;">
						<h1>S&iacute;guenos.</h1>
					</div>
					<div>
						<a href="<?php echo $entity->facebook; ?>" target="_blank"><img src="images/fb-big-icon.png" border="0" /></a>
						<a href="<?php echo $entity->twitter; ?>" target="_blank"><img src="images/twitter-big-icon.png" border="0" /></a>
					</div>
				</div>
			
				<div id="legal">
					El contenido sobre las entidades que se publican en Gibeet fu&eacute; provisto voluntariamente por las entidades en cuesti&oacute;n. Gibeet no asume responsabilidad alguna sobre dicho contenido.
					MercadoPago cobra una comisi&oacute;n por cada transacci&oacute;n realizada. Gibeet no cobra ni recibe ning&uacute;n tipo de comisi&oacute;n o beneficio por las donaciones realizadas. Todo lo recaudado se destina a la entidad involucrada.
				<div>				
			</div>

		</div>
	</div>
