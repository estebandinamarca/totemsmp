<?php
//phpinfo();
//echo "hola";

if($_POST)
{
	if (isset($_POST['radio1'])) $opc=$_POST['radio1']; else $opc=null;
	//echo $opc;
	switch($opc)
	{
		case "desc":
			$url  = 'http://www.mallplaza.cl/xml/descuentos.php?siteid=mallplaza-laserena';
			$path = 'src/xml/descuentos.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
		case "cine":
			$url  = 'http://www.mallplaza.cl/xml/cine.php?siteid=mallplaza-laserena';
			$path = 'src/xml/cine.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
		case "evento":
			$url  = 'http://www.mallplaza.cl/xml/eventos.php?siteid=mallplaza-laserena';
			$path = 'src/xml/eventos.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
	}
	echo "Carga realizada!";
	echo "<a href='updateContenidos.php'> Actualizar algo mas </a><br>";
	echo "<a href='index.html'> Volver al inicio </a>";

}
else
{
?>

<form action="updateContenidos.php" method="post" enctype="multipart/form-data">
		<table id="upload" border="0">
			<tr><th colspan="3">Actualizacion de contenidos</th></tr>
			<tr><td colspan="3" style="background-color: #FFF; color: #000000; font-size: 14px; text-align: center;">Seleccione la actualizacion de contenido: </td></tr>
			<tr><th style="background-color: #FFF; color: #000000; font-size: 12px;">Seleccione</th><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Descuento</td><td><input type="radio" name="radio1" id="tienda" value="desc"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Cartelera de cine</td><td><input type="radio" name="radio1" id="productos" value="cine"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Eventos</td><td><input type="radio" name="radio1" id="marcas" value="evento"/></td><td>&nbsp;</td></tr>
			

			
			<tr><td>&nbsp;</td><td>&nbsp;</td><td align="right"><input type="submit" name="subir" value="Cargar Archivo"/></td></tr>
		</table>	
	</form>	
<?php }?>