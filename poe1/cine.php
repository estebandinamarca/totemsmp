<?php
//------------------------------------------------
// CARGA DE ARCHIVO XML
//------------------------------------------------
if (file_exists('src/xml/cine.xml')) {
	$file= file_get_contents('src/xml/cine.xml');
	$file= str_replace("&nbsp;", " ", $file);
	$file= str_replace("&ndash;", "–", $file);
	$file= str_replace("&ntilde;", "ñ", $file);
	$file= str_replace("&hellip;", "…", $file);
	$file= str_replace("&ldquo;", "“", $file);
	$file= str_replace("&rdquo;", "”", $file);
	$file= str_replace("&rsquo;", "’", $file);
	$file= str_replace("&lsquo;","‘",$file); 
	$file= str_replace("%0A", "", $file);
	$file= str_replace("
</afiche>", "</afiche>", $file);
	$file="<?xml version='1.0' encoding='UTF-8'?>".$file;
	file_put_contents("src/xml/cine2.xml", $file);

    $xml = simplexml_load_file('src/xml/cine2.xml');
//------------------------------------------------
// FIN CARGA XML
//------------------------------------------------
    ?>

<!DOCTYPE html> 
<html> 
	<head> 
	    <meta charset="UTF-8" />
		<title>Mall Plaza</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
	</head> 
	

	<body> 
		<div data-role="page" id="cine" class="mall-inicio-bg">
		  	<script type="text/javascript">
				$('#cine').bind('pageshow', function(event, ui){
					var myScroll = new iScroll('wrapper-h-cine');
					//var myScroll2 = new iScroll('wrapper-h-horario');
				});	
			</script>
			<script>
				function habilita(i)
				{
					$('#cajaCine'+i+"").slideToggle("slow");
				}
			</script>

			<div data-role="content">
			    <div class="titulos">
				    <div class="volver-btn">
				    	<span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span>
				    </div>
				    <div class="titulo-txt">
				    	<h1>Cartelera</h1>
				    </div>
			    </div>
		    	<div class="bg-paginas-carrusel carrusel-cine">
					<div id="wrapper-h-cine">
						<script>ancho=470*(<?php echo $xml->count();?>+2); document.getElementById("scroller-h-cine").style.minWidth=ancho+"px";</script>
						<div id="scroller-h-cine" style=" height:100%;float:left;padding:0;">
							<ul id="thelist-h-cine">
					   		<?php
					   		$i=0;
					  		foreach ($xml->children() as $child)
							{
								?>
								<li><div id="fotoCine">
										<?php
										echo "<img src='".$child->afiche."' width='450' height='691'/>";
										?>
									</div>	
									<!-- <img src="src/img/cine/dictador.jpg" width="450" height="691"> -->
									<a href="#" class="boton info-cine" data-ajax="false" onclick="habilita('<?php echo $i;?>');"><span><p>Información</p></span></a>
									<div class="caja-cine" id="cajaCine<?php echo $i;?>" >
									<div id="tituloCine">
										<?php
										echo $child->titulo;
										?>
									</div>
									<!-- <div id="fotoCine">
										<?php
										echo "<img src='".$child->afiche."' width='155' height='248'/>";
										?>
									</div> -->
									<div id="reviewCorto">
										<?php
										echo $child->introtext->asXML();
										?>
									</div>
									<div id="horarioCine">
										<p class="horarios">Horarios</p>
										<div class="wrapper-h-horario" id="horarioScroll<?php echo $i;?>" style="height: 490px;position:relative;z-index:1; width auto; overflow:scroll;">
										    <div id="scroller-h-horario">
										        <ul>
											  		<?php
											  		echo "<li>";
													foreach( $child->horario->children() as $horario )
													{
														echo $horario->asXML();
													}
													echo "</li>";
											    	?>
										        </ul> 
										    </div> 
										</div>
										<script>
										var scroll<?php echo $i;?> = new iScroll('horarioScroll<?php echo $i;?>');
										</script>

									  	
									</div>
									<div id="reviewLargo">
									<?php
									/*
										foreach( $child->fulltext->children() as $review )
										{
											echo $review->asXML();
										}
									*/?>
									</div>
									</div>
								</li>
								<?php 
								$i++;
							} ?>
							</ul>
						</div>
					</div>
				</div>
				

				<div class="bottom-cine">
					<span><a href="#" class="como-llegar-cine fancybox.iframe button-mapa" onclick="cargaPagina('93','93');">¿Cómo llegar?</a></span>
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
							
							href:"getCaminoMasCorto.php?inicio=263&meta="+ubicacion+"&idTienda="+idTienda+""
						});
					}
					</script>
				</div>

				<div class="volver-bottom">
					<div class="volver-btn-bottom"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
				</div>

			</div>
		</div>

	</body>
</html>
<?php
} 
else {
    exit('Fallo al abrir XML.');
}
?>