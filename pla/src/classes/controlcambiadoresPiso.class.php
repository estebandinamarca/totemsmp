<?php

require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controlcambiadoresPiso
{
	public function insertaCambiadores($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO cambiadorpiso(idcambiadorPiso,idnodo,tipo,sube,baja,idnodoSubida,idnodoBajada) VALUES(?,?,?,?,?,?,?)";
		$respuesta = null;
		
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
	}
	
	public function getCambiadorPiso($piso)
	{
		$sql = conexionMySQLi::getInstance();
		$arr = array();
		$sentencia = "SELECT nodos.coordenadaReal, cambiadorpiso.tipo FROM `nodos`,`cambiadorpiso` WHERE !isnull(nodos.idcambiadorPiso) AND nodos.idnodo = cambiadorpiso.idnodo AND nodos.piso= ?";
		
		$result= $sql->devDatos($sentencia,array($piso));
		$result->bind_result($coordenadaReal,$tipo);

		while($result->fetch())
			{
				$arr[] = array('coordenadaReal'=>$coordenadaReal,'tipo'=>$tipo);
			}
			
			return $arr;	

	}
}
?>