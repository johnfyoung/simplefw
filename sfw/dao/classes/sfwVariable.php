<?php
/* $Id: sfwVariable.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwVariable.php
 * Created on Sep 27, 2007
 * by johnny
 */
 
/**
 * @orm sfwVariable
 */
class sfwVariable
{
	/**
	 * @orm char(255) unique(sfwVariable_name)
	 */
	public $name;
	
	/**
	 * @orm char(255)
	 */
	public $value;
	
	public static function get($name)
	{
		return sfwDAO::loadByQuery("sfwVariable", "name = '".$name."'");
	}
	
	public static function store($name, $value)
	{
		$var = self::get($name);
		if(!$var)
		{
			$var = sfwDAO::create("sfwVariable");
			$var->name = $name;
		}
		
		$var->value = serialize($value);
		if(sfwDAO::store($var))
		{
			return $var;
		}
		else
		{
			return null;
		}
	}
	
	public function value()
	{
		if(isset($this->value))
		{
			return unserialize($this->value);
		}

		return null;
	}
}
?>
