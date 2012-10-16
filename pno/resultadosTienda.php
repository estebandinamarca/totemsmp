<?php
require_once ("src/classes/controlTienda.class.php");

$res=$_GET["res"];
$bus=$_GET["bus"];
$tiendas= controlTienda::buscarTienda($res,$bus);
$numero= controlTienda::contarTienda($res,$bus);
if ($res!="todo")
{
if ($res!="[0-9]")echo "<div class='subtitulos'>
<h1>Resultados para: ".$res." (".$numero.") </h1>
</div>";
else 
	echo "<div class='subtitulos'>
	<h1>Resultados para: 0-9 (".$numero.") </h1>
	</div>";
}
else 
{
	echo "<div class='subtitulos'>
	<h1>Todas las tiendas. (".$numero.") </h1>
	</div>";	
}
?>	
  
<!-- iScroll 4.0 -->
<script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>
<!-- Fancybox 2.0.6 -->
<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
 
<div id="wrapper">
		<div id="scroller">
			<ul id="thelist">
	   	<?php
    	$inicial=null;
    	foreach ($tiendas as $result)
    	{
    		if ($res=="todo")
    		{
    			$val=$result->getnombre();
    			if($inicial!=$val[0])echo "<li class='divisor'>".$val[0]."</li>";
    			$inicial=$val[0];
    		}
    		?>
    		<li>
    		<a class='mapa fancybox.iframe' href="#" onclick= 'cargaPagina(<?php echo $result->getubiTienda();?>,<?php echo $result->getidtienda()?>)'>
    		<img src='src/img/logos/tiendas/<?php echo $result->getlogo();?>' width='120' height='100'>
    		</a>
    		<div class='nombre-tienda'>
    			
                
                <p class="texto-lista"><a class='mapa fancybox.iframe'
    				name="<?php echo $result->getidtienda();?>"
    				onclick= 'cargaPagina(<?php echo $result->getubiTienda();?>,<?php echo $result->getidtienda()?>)'><?php echo $result->getnombre();?></a></p>
                
                
                <p class="subtexto-lista">Nivel <?php echo  $result->getpiso(); ?></p></div>
    			<a class='button-mapa mapa fancybox.iframe'
    				name="<?php echo $result->getidtienda();?>"
    				onclick= 'cargaPagina(<?php echo $result->getubiTienda();?>,<?php echo $result->getidtienda()?>)'>
    			</a>
    			
    			<?php 
    	} 
    	?>
    	<!---<script> alert('<?php // echo  $_GET["res"];?>');</script>-->
    		</ul>
		</div><!-- / Fin container slidejs -->
	</div>

<script>var myScroll = new iScroll('wrapper');</script>
<script> 
function cargaPagina(ubicacion,idTienda)
{
	$(".mapa").fancybox({
		fitToView	: true,
		width		: 900,
		height		: 1100,
		padding 	: 40,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'fade',
		closeEffect	: 'elastic',
		openSpeed	: 'normal',
		helpers 	: { overlay : {opacity: 0.7, css : {'background-color' : '#440007'} } },
		href:"getCaminoMasCorto.php?inicio=263&meta="+ubicacion+"&idTienda="+idTienda+""
	});
}
</script>