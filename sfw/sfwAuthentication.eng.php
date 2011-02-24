<?php
/* $Id: sfwAuthentication.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwAuthentication.eng.php
 * Created on May 30, 2007
 * by johnny
 */

require_once SFW_PATH . "/sfwEncryption.eng.php";
require_once SFW_PATH . "/sfwCookie.eng.php";

/*
 * unauthorized access attempt
 */
class sfwAuthenticationException extends Exception {}

/**
 * sfwAuthentication Class
 * modified from "Advanced PHP Programming" by George Schlossnagle
 */
class sfwAuthentication
{
	/**
	 * checks supplied credentials against persistent storage
	 * @author johnny
	 * @access public
	 * @param string uname the login name
	 * @param string password the password
	 * @return object the found and authorized user
	 */
	public static function check_credentials($uname, $password)
	{
		//sfwLogger::log("sfwAuthenticate: check_credentials() - starting up...", LOGGER_LEVEL_DEBUG);
		if(empty($uname))
		{
			throw new sfwAuthenticationException(LANG_AUTH_ERROR_UNAMEEMPTY);
		}
		
		if(empty($password))
		{
			throw new sfwAuthenticationException(LANG_AUTH_ERROR_PASSEMPTY);
		}
		
		$uname = sfwSecurity::sanitizeText($uname);
		$password = sfwSecurity::sanitizeText($password);
		
		$user = null;
		$user = sfwDAO::loadByQuery("sfwUser", "uname = '". $uname ."'", null);
		
		if($user != null)
		{
			$pPass = sfwEncryption::decrypt($user->password);
			if($password === $pPass)
			{
				return $user;	
			}
			
			throw new sfwAuthenticationException(LANG_AUTH_FAILURE_BADPASS);
		}
		else
		{
			throw new sfwAuthenticationException(LANG_AUTH_FAILURE_NOTFOUND);
		}
		
		return null;
	}
	
	public static function check_auth()
	{
		//sfwLogger::log("sfwAuthenticate: check_auth() - starting up...", LOGGER_LEVEL_DEBUG);
		try
		{
			//sfwLogger::log("sfwAuthenticate: check_auth() - get cookie", LOGGER_LEVEL_DEBUG);
			$cookie = new sfwCookie();
			$cookie->validate();
			sfwLogger::log("sfwAuthenticate: check_auth() - cookie's valid...authenticated!", LOGGER_LEVEL_INFO);
			return true;
		}
		catch (sfwAuthenticationException $e)
		{
			//sfwLogger::log("sfwAuthenticate: check_auth() - found not authentic, redirect to login", LOGGER_LEVEL_DEBUG);
			header("Location:login.php?originating_uri=".$_SERVER['REQUEST_URI']);
		}
		return false;
	}
	
	public static function logout()
	{
		sfwLogger::log("sfwAuthenticate: logout()", LOGGER_LEVEL_INFO);
		$cookie = new sfwCookie();
		$cookie->logout();
		sfwAuthorization::unregister();
	}
}



?>