<?php

class totem
{
	private $idtotem;
	private $idnodo;
	private $nombre;
	private $orientacion;
		

	function __construct()
	{
		if(func_num_args()==4)
		{
			$this->idtotem = func_get_arg(0);
			$this->idnodo = func_get_arg(1);
			$this->nombre = func_get_arg(2);
			$this->orientacion = func_get_arg(3);
			
		}
		

	}

	public function setidtotem($value)
	{
		$this->idtotem = $value;
	}

	public function setidnodo($value)
	{
		$this->idnodo = $value;
	}

	public function setnombre($value)
	{
		$this->nombre = $value;
	}
	
	public function setorientacion($value)
	{
		$this->orientacion = $value;
	}
	

	
	######################GET#####################

	public function getidtotem()
	{
	return $this->idtotem;
	}

	public function getidnodo()
	{
	return $this->idnodo;
	}

	public function getnombre()
	{
	return $this->nombre;
	}
	
	public function getorientacion()
	{
	return $this->orientacion;
	}
			
}

?>