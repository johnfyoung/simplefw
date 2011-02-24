<?php
/* $Id: sfwLogger.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwLogger.eng.php
 * Created on Aug 4, 2007
 * by johnny
 */


class sfwLogger
{
	private static $_instance;
	public static $level;
	
	private function __construct()
	{
		$this->level = LOG_LEVEL;
	}
	
	public static function instance()
	{
		if(!isset(self::$_instance))
		{
			self::$_instance = new sfwLogger();
		}
		
		return self::$_instance;
	}
	
	public static function log($str, $level=10)
	{
		$i = self::instance();
		if($level <= $i->level)
		{
			$f = fopen(LOG_PATH . "/sfw.log", "a");
			
			if($f)
			{
				fwrite($f, date("Y-m-d H:i:s -- ") . $str . "\n");
			}
			fclose($f);
		}
	}
	
}

sfwLogger::instance();

?>
