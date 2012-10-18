<?php
require_once ("src/classes/controlTienda.class.php");
if(isset($_GET["rubro"]))$rub=$_GET["rubro"];
else $rub=null;

//$bus=$_GET["bus"];
$rubros = controlTienda::listarRubros($rub);
$numero=controlTienda::contarRubros();
?>  
<!-- Fancybox 2.0.6 -->
<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
<?php  
if ($rub!=null)
{
	$tiendasConRubro=controlTienda::tiendasConRubros($rub);
	//echo "<div id='scroller'><li class='divisor'>".$rubros->getnombre()."</li></div>";
	//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
	?>
	<div class="titulo-rubro">
    		<div class="volver-rubros-btn">
				<span><a href="#" data-transition="slide" data-direction="reverse"  onclick="cargaResultados(null,0)"></a></span></div>
				<?php echo $rubros->getnombre();?>
			</div>
	<div id="wrapper" class="wrapper-extendido-rubros">
 <?php 
} 
else 
{
?> 
	<div id="wrapper" class="wrapper-extendido wrapper-margin"> 
<?php 
}
?>
		<div id="scroller">
			<ul id="thelist">
    		<div id="resultadosRubros">
		
	   	<?php
    	$inicial=null;
    	if($rub!=null)
    	{
    		//var_dump($rubros);
    		//var_dump($rub);
    		?>
    		<?php 
    		//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
    		foreach ($tiendasConRubro as $tiendas)
    		{
    			?>
    			<li>
    			<a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			  
    			<img src='src/img/logos/tiendas/<?php echo $tiendas->getlogo();?>' width='120' height='100'>
    			</a>
    			<div class='nombre-tienda'>
    			<a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			<p class="texto-lista"><?php echo $tiendas->getnombre();?></p>
                <p class="subtexto-lista">Nivel <?php echo  $tiendas->getpiso();?></p>
                </a>
                </div>
    			<a class='button-mapa' 
    				name="<?php echo $tiendas->getidtienda();?>"
    				onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			</a>   	    			
    			<?php 
    		}
    		?>
    	    			
    	    <?php 
    	}
    	else
    	{
    		foreach ($rubros as $result)
    		{
    		?>
    		<li>
    		<a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);" data-transition="slide">
    			  
    		<img src='src/img/logos/rubros/<?php echo $result->getlogo();?>' width='120' height='100'>
    		</a>
    		<a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);" data-transition="slide">
    		<div class='nombre-tienda'>
    		<p class="texto-lista"><?php echo $result->getnombre();?></p></div>
    		</a>
    		
    		<a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);"class="button-mapa button-rubros" data-transition="slide"></a>
    		</li>	
    		<?php 
    		    		
    		} 
    	}
    	
    	?>
    	<!---<script> alert('<?php // echo  $_GET["res"];?>');</script>-->
    		</div>
    		</ul>
		</div><!-- / Fin container slidejs -->
	</div>



<script>var myScroll = new iScroll('wrapper');</script>

<script> 
function cargaPagina(ubicacion,idTienda)
{
	$.fancybox({
		type		: "iframe",
		fitToView	: true,
		width		: 900,
		height		: 1100,
		padding 	: 40,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'fade',
		closeEffect	: 'elastic',
		openSpeed	: 'normal',
		helpers 	: { overlay : {opacity: 0.5, css : {'background-color' : '#440007'} } },
		href		: "getCaminoMasCorto.php?inicio=263&meta="+ubicacion+"&idTienda="+idTienda+""
		
	});
}
function cargaResultados(idRubro,op)
{
	if (op=="1")
		{
			$('#resultadosRubros').slideToggle('slow', function() {
				$("#resultadosRubros").empty();
				$("#resultadosRubros").load("resultadosRubros.php?rubro="+idRubro+"");
				$("#resultadosRubros").show();
				
				
 			 });
			
		}
	else
		{ 
		$('#resultadosRubros').slideToggle('slow', function() {
			$("#resultadosRubros").empty();
			$("#resultadosRubros").load("resultadosRubros.php");
			$("#resultadosRubros").show();
			 })
			
		}
		
}
</script>

