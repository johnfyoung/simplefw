<?php
/* $Id: sfwErrors.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfErrors.php
 * Created on May 25, 2007
 * by johnny
 */

/*
 * type mismatch error
 */
class sfwTypeException extends Exception {}
class sfwBadInputException extends Exception {}

class sfwObjectExistsException extends Exception 
{
	private $obj;
	
	public function __construct(&$obj = null, $message = null, $code = 0)
	{
		parent::__construct($message, $code);
		$this->obj = $obj;
	}
}

class sfwFormException extends Exception 
{
	private $errors;
	
	public function __construct($errarray = null, $message = null, $code = 0)
	{
		parent::__construct($message, $code);
		$this->errors = $errarray;
	}
	
	public function getErrors()
	{
		return $this->errors;
	}
}

class sfwExceptionHandler
{
	public static function handler($e)
	{
		echo "SFW Exception handler:<br />";
		echo "<pre>\n";
		echo $e;
		echo "\n</pre>\n";
	}
	
	public static function h($msg, $e)
	{
		sfwLogger::log($msg . " caught exception -- " . $e->getMessage(), LOGGER_LEVEL_ERROR);
	}
	
	public static function uncaught($e)
	{
		sfwLogger::log("Uncaught Exception: " . $e->getMessage(), LOGGER_LEVEL_ERROR);
	}
}

?>
