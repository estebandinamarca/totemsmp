<?php
if(!defined('PATH_SOURCE_CORE'))
{
	define('PATH_SOURCE_CLASSES','src/classes/');
	define('PATH_SOURCE_CORE','src/core/');
	define('PATH_ABSOLUTE',dirname(__FILE__).DIRECTORY_SEPARATOR);
}
//if(!defined('PATH_SOURCE_CORE')) die ('Directorio de fuentes del nucleo no esta definida, por favor contacte al administrador o implementador.');
require_once(PATH_SOURCE_CORE.'conexionMySQLi.class.php');
require_once(PATH_SOURCE_CORE.'conf.class.php');


class controlCorreos
{
	function getCorreos($estado=null)
	{
		$sql=conexionMySQLi::getInstance();
		$arr=array();
		$consulta="SELECT idcorreo,tipoCorreo,nombre,rut,telefono,correoDestino,cuerpoMensaje,fecha
		 FROM correos where estado = ?";
		if($estado>-1)
		{
			$result= $sql->devDatos($consulta,$estado);
			
			$result->bind_result($idCorreo,$tipoCorreo,$nombre,$rut,$telefono,$correoDestino,$cuerpoMensaje,$fecha);
			
			
			while ($result->fetch())
			{
					
				$arr[] =array('idCorreo' => $idCorreo,'tipoCorreo' => $tipoCorreo,'nombre' => $nombre,'rut' => $rut,'telefono' => $telefono,'correoDestino' => $correoDestino,'cuerpoMensaje'=> $cuerpoMensaje,'fecha' => $fecha);
			}
			
		}
		else $arr=null;
		return $arr;
		
	}

	function insertCorreos($data=null,$estado=null)
	{
		$sql = conexionMySQLi::getInstance();
		$respuesta = null;
		if($estado > -1 &&$data!=null)
		{
			$sentencia = "INSERT INTO correos (tipoCorreo,nombre,rut,telefono,correoDestino,cuerpoMensaje,fecha,estado) VALUES(?,?,?,?,?,?,NOW(),'".$estado."')";
			$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		}
		
		
		return $respuesta;
	}

	function cambiarEstadoCorreos($idCorreo=null)
	{
		$sql = conexionMySQLi::getInstance();
		$respuesta = null;
		if($idCorreo!=null)
		{
			$sentencia = "UPDATE  `correos` SET  `estado` =  '1' WHERE  `correos`.`idcorreo` =?";
			$respuesta = $sql->ejecutarSentencia($sentencia,$idCorreo);
		}
		
		
		return $respuesta;
	}
	
	
	
	

	
	
}
?>