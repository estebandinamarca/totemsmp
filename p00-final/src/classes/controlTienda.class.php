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
require_once(PATH_SOURCE_CLASSES.'tienda.class.php');
require_once(PATH_SOURCE_CLASSES.'rubro.class.php');

class controlTienda
{
	function getTienda($id)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		
		$consulta="SELECT tienda.idtienda, tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.idtienda= ?";
		
		$result= $sql->devDatos($consulta,array($id));
		
		$result->bind_result($idTienda,$nombre,$logo,$piso,$ubi);
		
		
		if ($result->fetch())
		{
		
			$arr = new tienda($idTienda,$nombre,$logo,$piso,$ubi);
		}
		return $arr;
	}
	
	public static function buscarTienda($nombre,$buscador)
	{
		$sql=conexionMySQLi::getInstance();
		$arr= array();
		
		if ($nombre!="[0-9]")
		{
			$consulta="SELECT tienda.idtienda,tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
					FROM tienda, nodos, propiedadesTienda
					WHERE nodos.idnodo = propiedadesTienda.idnodo
					AND tienda.idtienda = propiedadesTienda.idtienda
					AND tienda.nombre LIKE ?
					ORDER BY tienda.nombre ASC ";
		
		
			
		}
		else 
		{
			$consulta="SELECT tienda.idtienda, tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre RLIKE ?
			ORDER BY tienda.nombre ASC ";
			
			
		}
		if ($nombre!="todo")$result= $sql->devDatos($consulta,array($nombre.'%'));
		else $result= $sql->devDatos($consulta,array('%%'));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
	
		}
		return $arr;
	}
	
	public static function contarTienda($nombre,$buscador)
	{
		$sql=conexionMySQLi::getInstance();
		if ($nombre!="[0-9]")
		{
			$consulta="SELECT count( tienda.nombre ) 
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre LIKE ?
			ORDER BY tienda.nombre ASC ";
				
		}
		else
		{
			$consulta="SELECT count( tienda.nombre ) 
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre RLIKE ?
			ORDER BY tienda.nombre ASC ";
				
				
		}
		
		if ($nombre!="todo") $result= $sql->devDatos($consulta,array($nombre.'%'));
		else $result= $sql->devDatos($consulta,array('%%'));
		$result->bind_result($numero);
		if ($result->fetch())return $numero;
		
		
	}
	
	public static function listarRubros($rubro=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		if ($rubro==null)$consulta= "SELECT idrubro,nombre,logo FROM rubro where idrubro <> ? order by nombre asc ";
		else $consulta= "SELECT idrubro,nombre,logo FROM rubro where idrubro = ? ";
		$result= $sql->devDatos($consulta,array("".$rubro.""));
		$result->bind_result($idrubro,$nombre,$logo);
		if ($rubro==null)
		{
			while ($result->fetch())
			{
				$arr[] = new rubro($idrubro,$nombre,$logo);
			}
		}
		else
		{
			if ($result->fetch()) $arr = new rubro($idrubro,$nombre,$logo);
		}
		//var_dump($arr);
		return $arr;
	}
	
	public static function contarRubros()
	{
		$vac="";
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT count(idrubro) FROM rubro where idrubro <> ?";
		$result= $sql->devDatos($consulta,array($vac));
		$result->bind_result($numero);
		if ($result->fetch())return $numero;
		
	}
	
	public function tiendasConRubros($idrubro)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, detalleRubro, rubro,nodos,propiedadesTienda
		WHERE tienda.idtienda = detalleRubro.idtienda
		AND detalleRubro.idrubro = rubro.idrubro
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND rubro.idrubro = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idrubro));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		return $arr;
		
		
	}
	
	public function productoEnTiendas($idproducto)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, nodos,propiedadesTienda, detalleTienda,producto
		WHERE producto.idproducto = detalleTienda.idproducto
		AND tienda.idtienda = detalleTienda.idtienda
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND producto.idproducto = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idproducto));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		
		return $arr;
		
		
	}
	
	public function marcaEnTiendas($idmarca)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, nodos,propiedadesTienda,detalleMarca,marca
		WHERE marca.idmarca = detalleMarca.idmarca
		AND tienda.idtienda = detalleMarca.idtienda
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND marca.idmarca = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idmarca));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		
		return $arr;
		
		
	}
	
	

	
}
?>