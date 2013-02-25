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
	
}
?>