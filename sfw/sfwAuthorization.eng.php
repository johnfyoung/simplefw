<?php
/* $Id: sfwAuthorization.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwAuthorization.eng.php
 * Created on Aug 3, 2007
 * by johnny
 */
 
class sfwAuthorizationException extends Exception {}

class sfwAuthorization
{
	private static $_user;
	private static $_instance;
	private static $_perm;
	
	private function __construct(&$user=null)
	{
		$this->register($user);
	}
	
	public static function instance()
	{
		if(!isset(self::$_instance))
		{
			self::$_instance = new sfwAuthorization();
		}
		
		return self::$_instance;
	}
	
	public static function bootstrap()
	{
		//sfwLogger::log("sfwAuthorization: bootstrap() - starting...");
		try
		{
			self::$_perm = sfwDAO::loadByQuery("sfwPermission", "url = '" . $_SERVER['REQUEST_URI']."'");
			if(empty(self::$_perm))
			{
				//sfwLogger::log("sfwAuthorization: bootstrap() - create permission...", LOGGER_LEVEL_DEBUG);
				$p = sfwDAO::create("sfwPermission");
				$p->url = $_SERVER['REQUEST_URI'];
				$p->commit();
				self::$_perm = $p;
			}
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::handler($e);
		}
	}
	
	public static function register(&$user)
	{
		//sfwLogger::log("sfwAuthorization: register() - starting...");
		if(isset($user) && is_obj($user, "sfwUser"))
		{
			//sfwLogger::log("sfwAuthorization: register() - user checks out!", LOGGER_LEVEL_DEBUG);
			self::$_user = $user;
			$cookie = new sfwCookie(sfwDAO::objID($user));
			$cookie->set();
		}
		else
		{
			//sfwLogger::log("sfwAuthorization: register() - no user!", LOGGER_LEVEL_DEBUG);
			self::$_user = null;
		}
	}
	
	public static function unregister()
	{
		//sfwLogger::log("sfwAuthorization: unregister() - starting up...", LOGGER_LEVEL_DEBUG);
		if(isset(self::$_user))
		{
			$_user = null;
		}
	}
	
	public static function currentUser()
	{
		//sfwLogger::log("sfwAuthorization: currentUser() - starting up...", LOGGER_LEVEL_DEBUG);
		try
		{
			if(empty(self::$_user))
			{
				$cookie = new sfwCookie();
				$userid = $cookie->currentUserId();
				if(!empty($userid))
				{
					//sfwLogger::log("sfwAuthorization: currentUser() - found userid in cookie, getting user", LOGGER_LEVEL_DEBUG);
					self::$_user = sfwDAO::loadByORMID("sfwUser", $userid);
				}
				else
				{
					//sfwLogger::log("sfwAuthorization: currentUser() - found no user in cookie userid", LOGGER_LEVEL_DEBUG);
					self::$_user = null;
				}
			}
		}
		catch(sfwAuthenticationException $e)
		{
			sfwLogger::log("sfwAuthorization: currentUser() - cought an authentication problem", LOGGER_LEVEL_ERROR);
			self::$_user = null;
		}
		return self::$_user;
	}
	
	public static function check_allowed($perm)
	{
		//sfwLogger::log("sfwAuthorization: check_allowed() - starting up...", LOGGER_LEVEL_DEBUG);
		$allowed = false;
		if(empty($perm->roles))
		{
			//sfwLogger::log("sfwAuthorization: check_allowed() - no roles for this permission", LOGGER_LEVEL_DEBUG);
			$allowed = true;
		}
		else
		{
			//sfwLogger::log("sfwAuthorization: check_allowed() - permission is requires privlege...", LOGGER_LEVEL_DEBUG);
			$user = self::currentUser();
			if($user != null)
			{		
				foreach($user->roles as $ur)
				{
					foreach($perm->roles as $pr)
					{
						if(sfwDAO::compare($ur,$pr))
						{
							$allowed = true;
						}
					}
				}
			}
		}
		
		if($allowed)
		{
			//sfwLogger::log("sfwAuthorization: check_allowed() - authorized!", LOGGER_LEVEL_DEBUG);
			return $allowed;
		}
		else
		{
			sfwLogger::log("sfwAuthorization: check_allowed() - not authorized!", LOGGER_LEVEL_INFO);
			throw new sfwAuthorizationException(LANG_AUTH_FAILURE_NOTALLOWED);
		}
		
		return false;
	}
	
	public static function grantCurrent($role)
	{
		return self::grant($role, self::$_perm);
	}
	
	public static function grant($role, $perm)
	{
		//sfwLogger::log("sfwAuthorization: grant() - starting up...", LOGGER_LEVEL_DEBUG);
		if(is_obj($role, "sfwRole") && is_obj($perm, "sfwPermission"))
		{	
			foreach($role->perms as $p)
			{
				if(sfwDAO::compare($p,$perm))
				{
					return;
				}
			}
			$role->perms[] = $perm;
			sfwDAO::store($role);
		}
		else
		{
			throw new sfwTypeException("Permission Grant recieved bad object");
		}
	}
	
	public static function revoke($role, $perm)
	{
		if(is_obj($role, "sfwRole") && is_obj($perm, "sfwPermission"))
		{	
			$i = 0;
			foreach($role->perms as $p)
			{
				if(sfwDAO::compare($p,$perm))
				{
					$role->perms[$i] = "";
					return;
				}
				$i++;
			}	
		}
		else
		{
			throw new sfwTypeException("Permission Grant recieved bad object");
		}
	}
	
	public static function check_perm()
	{
		//sfwLogger::log("sfwAuthorization: check_perm() - starting...", LOGGER_LEVEL_DEBUG);
		try
		{
			if(self::$_perm)
			{
				if(!empty(self::$_perm->roles))
				{
					//sfwLogger::log("sfwAuthorization: check_perm() - this perm has roles, check if authenticated", LOGGER_LEVEL_DEBUG);
					sfwAuthentication::check_auth();
					//sfwLogger::log("sfwAuthorization: check_perm() - this perm has roles, check if allowed", LOGGER_LEVEL_DEBUG);
					return self::check_allowed(self::$_perm);
				}
			}
		}
		catch(sfwAuthorizationException $e)
		{
			//sfwExceptionHandler::handler($e);
			sfwLogger::log("sfwAuthorization: check_perm() - check_perm failed!", LOGGER_LEVEL_WARNING);
		}
	}
	
	public static function getRole($label)
	{
		$role = sfwDAO::loadByQuery("sfwRole", "label = '$label'");
		if(!empty($role))
		{
			return $role;
		}
		
		return false;
	}
}

//sfwLogger::log("sfwAuthorization: get instance...", LOGGER_LEVEL_DEBUG);
sfwAuthorization::instance();
sfwAuthorization::bootstrap();

?>
