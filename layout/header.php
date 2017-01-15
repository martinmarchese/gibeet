	<div>
		<a href="home"><img src="<?php echo $path?>images/logo.png" alt="Gibeet.com" height="85" border="0"/></a>
	</div>

	<ul id="menu">		
		<?php if (isLogged()) { ?>
			
			<?php $loggedUser = getLoggedUser(); ?>
			<li><a href="panel">MIS ACCIONES<br/><span style="color:#5E94FF">Mis acciones RSE</span></a></li>
			<li><a href="servicios">&iquest;QUE OFRECEMOS?<br/><span>Sorpr&eacute;ndete y elige</span></a></li>
			<li><a id="motivos" href="motivos">&iquest;POR QU&Eacute;?<br/><span>Las claves de la RSE 2.0</span></a></li>
			<li class="user" title="Salir" onclick="$.fn.redirect('logout')"><a href="logout"><?php echo $loggedUser->name?></a></li>
		<?php } else { ?>
			<!-- li><a href="login">LOGIN<br/><span>Ingresa!</span></a></li-->
			<li><a href="registro">FORMA PARTE<br/><span>Comienza y&aacute;!</span></a></li>
			<li><a href="servicios">&iquest;QUE OFRECEMOS?<br/><span>Sorpr&eacute;ndete y elige</span></a></li>
			<li><a id="motivos" href="motivos">&iquest;POR QU&Eacute;?<br/><span>Las claves de la RSE 2.0</span></a></li>
			<li><a href="http://www.facebook.com/gibeet/" target="_blank"><img src="images/fb-big-icon.png" height="30" border="0" /></a></li>
		<?php } ?>
	
	</ul>
	
	
				