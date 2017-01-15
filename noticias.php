<?php 
@include_once 'config/constants.php';
@include_once 'model/User.class.php';
@include_once 'service/UserService.class.php';
include_once 'model/News.class.php';
include_once 'model/Entity.class.php';
include_once 'service/UserService.class.php';
include_once 'service/EntityService.class.php';
	
$entityUsername = $_GET["entidad"];

$news = array();
$entityService = new EntityService();
$news = $entityService->getEntityActivity($entityUsername);

?>

<h1>Noticias</h1>
<h3>Enterate sobre las novedades de tu entidad amiga</h3>

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