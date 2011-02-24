<?php
/* $Id: sfwSessionHandler.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwSessionHandler.php
 * Created on Aug 1, 2007
 * by johnny
 */

class sfwSessionHandler
{
	// TODO since the session handling doesn work with ezpdo, until I get 
	// it fixed I need to do garbage collection
	public static $maxtime;
	public static $gc_prob;
	private static $_instance;
	
	private function __construct()
	{
		//sfwLogger::log("sfwSessionHandler: __construct - starting up...", LOGGER_LEVEL_DEBUG);
		self::$maxtime = 5 * 60 * 60;
		self::$gc_prob = 100;
	}
	
	public static function instance()
	{
		if(!isset(self::$_instance))
		{
			self::$_instance = new sfwSessionHandler();
		}
		
		return self::$_instance;
	}
	
	public static function open($save_path, $session_name)
	{
		// nothing to do here
		return(true);
	}

	public static function close()
	{
		// nothing to do here
		return(true);
	}

	public static function read($id)
	{
		try
		{
			//$session = sfwDAO::loadByQuery("sfwSession", "sess_id = '" . $id ."'");
			$session = self::get($id);
			
			if($session)
			{
				return $session->data;	
			}
			else
			{
				return null;
			}
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::handler($e);
		}
	}
	
	public static function get($id)
	{
		try
		{
			$m = epManager::instance();
			$result = epManager::instance()->find("from sfwSession as z where z.sess_id = ?", $id);
			if($result)
			{
				return $result[0];
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::handler($e);
		}
	}
	
	public static function getCurrent()
	{
		return self::get(session_id());
	}	

	public static function write($id, $sess_data)
	{
		//sfwLogger::log("sfwSessionHandler: write() - starting up...", LOGGER_LEVEL_DEBUG);
		try
		{
			$clean_data = mysql_escape_string($sess_data);
			$session = sfwDAO::loadByQuery("sfwSession", "sess_id = '$id'");
			
			$ts = time();
			
			if(empty($session))
			{
				//sfwLogger::log("sfwSessionHandler: write() - create new session", LOGGER_LEVEL_DEBUG);
				$session = sfwDAO::create("sfwSession");
				$session->sess_id = $id;
				$session->createtime = $ts;
			}
			
			//sfwLogger::log("sfwSessionHandler: write() - got a session", LOGGER_LEVEL_DEBUG);
			$session->data = $sess_data;
			$session->modtime = $ts;
			return sfwDAO::store($session);
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::h("Problem writing session", $e);
		}
	}

	public static function destroy($id)
	{
		$session = sfwDAO::loadByQuery("sfwSession", "sess_id = '" . $id ."'");
		if($session)
		{
			return sfwDAO::delete($session);
			
		}
		$_SESSION = array();
		return true;
	}

	public static function gc($maxlifetime)
	{
		//sfwLogger::log("sfwSessionHandler: gc() - starting up", LOGGER_LEVEL_DEBUG);
		$gc_prob_target = self::$gc_prob / 2;
		$rand = mt_rand(1, self::$gc_prob);

		if($rand == $gc_prob_target)
		{
			$ts = time() - $maxlifetime;
			$sessions = epManager::instance()->find("from sfwSession where modtime < ?", $ts);
			
			if(isset($sessions))
			{
				foreach($sessions as $s)
				{
					sfwDAO::delete($s);
				}
			}
		}
	}

}

// TODO ezpdo and setting a save handler are not working - something to do with shutting down the db object prematurely in ezpdo
//session_set_save_handler("sfwSessionHandler::open", "sfwSessionHandler::close", "sfwSessionHandler::read", "sfwSessionHandler::write", "sfwSessionHandler::destroy", "sfwSessionHandler::gc");

//sfwLogger::log("sfwSessionHandler: starting session...", LOGGER_LEVEL_DEBUG);
@session_name(SESSION_NAME);
@session_start();

sfwSessionHandler::instance();

sfwSessionHandler::write(session_id(), serialize($_SESSION));
sfwSessionHandler::gc(sfwSessionHandler::$maxtime);
?>
