<?php
?>
<!DOCTYPE html> 
<html> 
	<head> 
    <meta charset="UTF-8" />
	<title>Mall Plaza</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- Jquery Library 1.7.1 -->
	<script src="src/js/jquery-1.7.1.min.js"></script>
    <!-- Jquery Mobile 1.1.0 -->
	<script src="src/js/jquery.mobile/jquery.mobile.custom.min.js"></script>
    <link rel="stylesheet" href="src/css/jquery.mobile/jquery.mobile.custom.structure.css" />
    <link rel="stylesheet" href="src/css/jquery.mobile/jquery.mobile.custom.theme.min.css" />
	<!-- iScroll 4.0 -->
	<script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>        
    <!-- Estilo Base -->
    <link rel="stylesheet" href="src/css/base/estilo.base.css" />
    <!-- Fancybox 2.0.6 -->
    <link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>    
    <!-- Timeout -->
    <script type="text/JavaScript">
	var timeout;
	document.onmousemove = function(){
  	clearTimeout(timeout);
  	timeout = setTimeout(function(){top.location.href='protector.html'}, 360000);
	}
	</script>  
	</head>

<body>
<div data-role="page" id="busqueda-tiendas" class="mall-inicio-bg">

	<script>
	$(window).bind("load", function() {
    $('#dvLoading').fadeOut(1700);
    });

	$(document).ready(function() {
		$(".efecto-pagina").css("display", "none");
		$('.efecto-pagina').fadeIn(2500);	
        /*---- ESTADISTICAS POR PAGINA------*/
        var ur = window.location.href;
        ur=ur.split("/");
        ur=ur[4].split(".");
        ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/
	  });
	</script>
	<div id="dvLoading"></div>

	<div data-role="content">
		<div class="titulos">
    		<div class="volver-btn"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
    		<div class="titulo-txt">
    			<h1>Busca como quieras</h1>
    		</div>
    	</div>

    	<div class="contenedor-busqueda">
			<div  class="contenedor-busquedas-btn">
				<ul class="busquedas">
					<li class="current"><a href="#" >Por Tienda</a></li>
                    <li><a href="busquedaRubros.php" data-transition="fade" rel="external" >Por Rubro</a></li>
                    <li><a href="busquedaMarcas.php" data-transition="fade" rel="external">Por Marcas</a></li>
					<li><a href="busquedaProductos.php" data-transition="fade" rel="external">Por Producto</a></li>
				</ul> 
			</div> 
			<div class="contenedor-flechas">
                <div class="flecha flecha-current"></div>
				<div class="flecha"></div>
				<div class="flecha "></div>
				<div class="flecha"></div>
			</div>

			<div class="bg-busquedas">
			<div class="alfabeto">
			<fieldset data-role="controlgroup" data-type="horizontal">
         		<input type="radio" name="radio-choice-2" id="radio-choice-21" value="choice-1" checked="checked" onClick="buscaTiendas('todo');" />
         		<label for="radio-choice-21">VER TODAS</label>

         		<input type="radio" name="radio-choice-2" id="radio-choice-22" value="choice-2" onClick="buscaTiendas('A');" />
         		<label for="radio-choice-22">A</label>

         		<input type="radio" name="radio-choice-2" id="radio-choice-23" value="choice-3" onClick="buscaTiendas('B');" />
         		<label for="radio-choice-23">B</label>

         		<input type="radio" name="radio-choice-2" id="radio-choice-24" value="choice-4" onClick="buscaTiendas('C');" />
         		<label for="radio-choice-24">C</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-25" value="choice-5"  onclick="buscaTiendas('D');"/>
         		<label for="radio-choice-25">D</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-26" value="choice-6"  onclick="buscaTiendas('E');"/>
         		<label for="radio-choice-26">E</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-27" value="choice-7" onClick="buscaTiendas('F');" />
         		<label for="radio-choice-27">F</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-28" value="choice-8" onClick="buscaTiendas('G');" />
         		<label for="radio-choice-28">G</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-29" value="choice-9" onClick="buscaTiendas('H');" />
         		<label for="radio-choice-29">H</label>

            	<input type="radio" name="radio-choice-2" id="radio-choice-30" value="choice-10" onClick="buscaTiendas('I');" />
         		<label for="radio-choice-30">I</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-31" value="choice-11" onClick="buscaTiendas('J');" />
         		<label for="radio-choice-31">J</label>
            
         	   <input type="radio" name="radio-choice-2" id="radio-choice-32" value="choice-12" onClick="buscaTiendas('K');" />
         		<label for="radio-choice-32">K</label>                                                      

	         	<input type="radio" name="radio-choice-2" id="radio-choice-33" value="choice-13" onClick="buscaTiendas('L');"/>
    	     	<label for="radio-choice-33">L</label>

        	 	<input type="radio" name="radio-choice-2" id="radio-choice-34" value="choice-14"  onclick="buscaTiendas('M');"/>
         		<label for="radio-choice-34">M</label>

	         	<input type="radio" name="radio-choice-2" id="radio-choice-35" value="choice-15" onClick="buscaTiendas('N');" />
    	     	<label for="radio-choice-35">N</label>
	
    	     	<input type="radio" name="radio-choice-2" id="radio-choice-36" value="choice-16" style="margin:0 0 0 70px"  onclick="buscaTiendas('O');"/>
        	 	<label for="radio-choice-36" style="margin:0 0 0 70px">O</label>
            
            	<input type="radio" name="radio-choice-2" id="radio-choice-37" value="choice-17" onClick="buscaTiendas('P');" />
	         	<label for="radio-choice-37">P</label>
    	        
        	    <input type="radio" name="radio-choice-2" id="radio-choice-38" value="choice-18" onClick="buscaTiendas('Q');" />
         		<label for="radio-choice-38">Q</label>
            
	            <input type="radio" name="radio-choice-2" id="radio-choice-39" value="choice-19" onClick="buscaTiendas('R');" />
    	     	<label for="radio-choice-39">R</label>
            
 	           	<input type="radio" name="radio-choice-2" id="radio-choice-40" value="choice-20" onClick="buscaTiendas('S');" />
 	        	<label for="radio-choice-40">S</label>
	            
	            <input type="radio" name="radio-choice-2" id="radio-choice-41" value="choice-21" onClick="buscaTiendas('T');" />
	         	<label for="radio-choice-41">T</label>

            	<input type="radio" name="radio-choice-2" id="radio-choice-42" value="choice-22" onClick="buscaTiendas('U');" />
         		<label for="radio-choice-42">U</label>
            
	            <input type="radio" name="radio-choice-2" id="radio-choice-43" value="choice-23" onClick="buscaTiendas('V');" />
    	     	<label for="radio-choice-43">V</label>
            
        	    <input type="radio" name="radio-choice-2" id="radio-choice-44" value="choice-24" onClick="buscaTiendas('W');" />
         		<label for="radio-choice-44">W</label>
            
	            <input type="radio" name="radio-choice-2" id="radio-choice-45" value="choice-25" onClick="buscaTiendas('X');" />
    	     	<label for="radio-choice-45">X</label>

        	    <input type="radio" name="radio-choice-2" id="radio-choice-46" value="choice-26" onClick="buscaTiendas('Y');" />
         		<label for="radio-choice-46">Y</label>
            
	            <input type="radio" name="radio-choice-2" id="radio-choice-47" value="choice-27" onClick="buscaTiendas('Z');" />
    	     	<label for="radio-choice-47">Z</label>
            
        	    <input type="radio" name="radio-choice-2" id="radio-choice-48" value="choice-28" onClick="buscaTiendas('[0-9]');" />
         		<label for="radio-choice-48">0-9</label>                                                                     
            
   		 </fieldset>
				
			</div>
				<div id="resultadosTiendas" class="efecto-pagina" style="text-align: center; margin: 0; padding: 0;"></div>
			</div>
		</div><!-- /contenedor-busqueda -->
        
    <div class="volver-bottom">
    <div class="volver-btn-bottom"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
    </div>
    
	</div><!-- /content -->
</div><!-- /page -->

<script>
document.onload=buscaTiendas('todo');
var i=1;
var a="";
function buscaTiendas(letra){
	$("#resultadosTiendas").load("resultadosTienda.php?bus=1&res="+letra+"");
			return true;
}
</script>
</body> 
</html>
