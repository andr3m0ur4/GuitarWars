<?php  

class GuitarWar
{

	private $data;

	public function __get ( $prop )
	{
		return $this -> data[$prop];
	}

	public function __set ( $prop, $value )
	{
		$this -> data[$prop] = $value;
	}
	
}
