<?php
require_once 'src/classes/controlCorreos.class.php';

$correos=controlCorreos::getCorreos('0');
if(count($correos)>0)
{

	$from_name = "Mall Plaza Sur";
	$from_email = "mensajes.mallplaza@gmail.com";
	$headers = "From: $from_name <$from_email>";
	$subject = "Correos no enviados desde Mall Plaza Sur";
	$body = "Los siguientes correos no fueron enviados en el dia de su generacion desde Mall Plaza Sur, estos son:\n";
	foreach($correos as $result)
	{

		$body.="Tipo de mensaje: ".$result['tipoCorreo']."\n Nombre: ".$result['nombre']."\nRUT: ".$result['rut']."\nTelefono: ".$result['telefono']."\nCorreo: ".$result['correoDestino']."\nMensaje: ".$result['cuerpoMensaje']."\n\n\n";
		
	}

	$body.="Gracias";
 	//$to = "callcenter@fidelis.cl,ropazo@fidelis.cl,juan.martinez@mallplaza.cl";
		 
	//print_r($body);
	$to="ncastillo@dreamit.cl";
	if (mail($to, $subject, $body, $headers)) 
	{
		foreach($correos as $enviados)
		{
			controlCorreos::cambiarEstadoCorreos($enviados['idCorreo']);	
		}
		
		echo "eexito!";

	} 
	else 
	{
	    echo "fallo".
	
	   
	}
}
?>
