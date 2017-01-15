<?php 
	include_once 'library/Secure.php';
	include_once 'model/News.class.php';
	include_once 'model/Entity.class.php';
	include_once 'service/UserService.class.php';
	include_once 'service/EntityService.class.php';
	
	$userService = new UserService();
	$entityFriend = $userService->getFriendEntity(getLoggedUser());
		
	$news = array();
	if ($entityFriend != null) {
		$entityService = new EntityService();
		$news = $entityService->getEntityActivity($entityFriend->username);
	}
?>

	<div id="panel-header">
		<h1 class="panel-title">Encuentra a qui&eacute;n ayudar,<br/> alguiente te necesita</h1>
				
		<div class="text-container">
			<div style="color:#00afe1">Hay una ONG que necesita exactamente lo que t&uacute; puedes darle.</div>
			<div>
				Utiliza el buscador y encu&eacute;ntrala.
				<br/>
				Ayuda a cumplir sus sueños.  
			</div>
		</div>
		
		<div style="position: relative;float:left; overflow: hidden; width: 100%;">
		
			<div style="float:left">
				<form id="searchForm" onsubmit="return false">
						<input type="text" class="input-search" id="inputSearch" name="inputSearch" onkeypress="$.fn.search(event)" style="width:500px" maxlength="50" />
						<div class="searchButtonHidden" onclick="$.fn.search(event)">&nbsp;</div>
				</form>
			</div>
			<ul class="menu">
				<li class="blue"><a id="eventos20" onclick="$.fn.showModal(this.id)">eventos 2.0</a></li>
				<li class="orange"><a id="colectasoff" onclick="$.fn.showModal(this.id)">colectas offline</a></li>
				<li class="black" style="margin-left:0px"><a id="colectas20" onclick="$.fn.showModal(this.id, null, 430)">colectas 2.0</a></li>
			</ul>
		</div>
	</div>

	<div id="panel-content">

		<div class="panel-options">
			<div class="panel-option diffuse" id="difundir" onclick="$.fn.showModal(this.id, null, null, 'entityname=<?php echo urlencode($entityFriend->name)?>&entityusername=<?php echo urlencode($entityFriend->username)?>&loggedUser=<?php echo getLoggedUser()->username?>')" onmouseover="$.fn.showPanelTooltip('diffuse')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ></div>
			<div class="panel-option contact" id="contactos" onclick="$.fn.showModal(this.id, null, 450)" onmouseover="$.fn.showPanelTooltip('contact')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ></div>					
			<div class="panel-option edit"	  id="perfil" onclick="$.fn.showModal(this.id, 750, 450)" onmouseover="$.fn.showPanelTooltip('edit')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ></div>
			<!-- 
			<div class="panel-option help"	  id="ayuda" onclick="$.fn.showModal(this.id)" onmouseover="$.fn.showPanelTooltip('help')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ></div>			
			 -->
			<?php if ($entityFriend != null) { ?>
				<div class="panel-option cancel" onclick="$.fn.unfriend()" onmouseover="$.fn.showPanelTooltip('cancel')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ></div>
			<?php } ?>
			<div id="panel-options-loading" style="padding-top:10px"></div>
		</div>

		<div>
			<div id="entity-friend" class="entity-friend">
			
				<?php if ($entityFriend == null) { ?>
					<br/><br/><br/><br/><br/><br/>
					<center>
						<h1>Todav&iacute;a no tienes ninguna ONG amiga.</h1>
						<h3>Utiliza el buscador para encontrar una entidad a la que tu empresa pueda ayudar.</h3>
					</center>
					<br/><br/><br/><br/><br/>
				<?php } else { ?>

					<div style="float:left; margin-right:10px;">
						<a href="<?php echo $entityFriend->username?>" title="Visitar!" >
							<img src="entities/<?php echo $entityFriend->username?>/search.jpg" />
						</a>
					</div>	
					<div style="padding-top:15px;">
						<h1>Tu entidad amiga</h1>
						<h2><a href="<?php echo $entityFriend->username?>" title="Visitar!" style="color:#00AFE1" target="_blank" onmouseover="$.fn.showPanelTooltip('entityfriend')" onmouseout="panelTooltip.pnotify_remove();" onmousemove="panelTooltip.css({'top': event.clientY+12, 'left': event.clientX+12});" ><?php echo $entityFriend->name ?></a></h2>
					</div>
				
					<!-- Novedades -->
					<div class="news-container">
						<h1 class="news-title"><img src="images/title-icon.png" height="25" />Novedades</h1>
						<?php if (count($news) == 0) { ?>
							<h3 class="news-empty">
								<b><?php echo $entityFriend->name ?></b>, 
								<br/>
								 todav&iacute;a no ha compartido ninguna noticia sobre acciones RSE de alguna empresa.
							</h3>
						<?php } ?>
						<?php foreach ($news as $n) { ?>
							<a name="<?php echo $n->id?>"></a>
							<div class="post">
								<div class="image">
									<img src="<?php echo $n->image ?>" />
								</div>
								<div class="content">
									<h2><?php echo $n->title ?></h2>
									<div class="date"><?php echo date(DATE_APP_FORMAT, strtotime($n->date)) ?></div>
									<div class="text"><?php echo $n->text ?></div>
									<div class="share">
										<a href="https://www.facebook.com/dialog/feed?app_id=236578669695749&link=http://www.gibeet.com.ar/index.php?sk=noticias%26entidad=<?php echo $entityFriend->username?>%23<?php echo $n->id?>&picture=<?php echo $n->image ?>&name=<?php echo $n->title?>&caption=<?php echo substr($n->text, 0, 100) . "..." ?>&redirect_uri=http://www.gibeet.com/">
											<img src="images/fb-icon.png" height="20" />
										</a>							
										<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.gibeet.com.ar/index.php?sk=noticias&amp;entidad=<?php echo $entityFriend->username?>#<?php echo $n->id?>" data-via="gibeetcom" data-lang="es" data-count="none" data-hashtags="RSE2.0">Twittear</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
			    <?php } ?>
				
			</div>
			<div id="search-results" style="display:none;">
				<div style="float:left">
					<h1>Resultados de la b&uacute;squeda</h1>
				</div>
				<div style="float:right" class="button-back" onclick="$.fn.redirect('panel')">Volver</div>
				<div id="search-results-content"></div>
			</div>
			<div id="search-loading" style="padding-top: 120px;"></div>
		</div>
		
	</div>
