<?php
/* $Id: sfwCookie.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwCookie.php
 * Created on May 29, 2007
 * by johnny
 */


/**
 * Web Browser Cookie
 * modified from "Advanced PHP Programming" by George Schlossnagle
 */
class sfwCookie
{
	private $created;
	private $userid;
	private $version;
	private $cookie;

	private $cookiename = 'SFWCOOKIE';
	private $myversion  = '1';
	private $expiration = '600';  
	private $warning    = '300';
	private $glue = '|';

	public function __construct($userid = false)
	{
		//sfwLogger::log("sfwCookie:  __construct() - starting up...", LOGGER_LEVEL_DEBUG);
		if($userid)
		{
			$this->userid = $userid;
			return;
		}
		else
		{
			if(array_key_exists($this->cookiename, $_COOKIE))
			{
				$buffer = $this->_unpackage($_COOKIE[$this->cookiename]);
			}
			else
			{
				//sfwLogger::log("sfwCookie: __construct() - no cookie to unpack", LOGGER_LEVEL_DEBUG);
				throw new sfwAuthenticationException(LANG_COOKIE_ERROR_NOCOOKIE);
			}
		}
	}
    
	public function set()
	{
		//sfwLogger::log("sfwCookie: set() - starting up...", LOGGER_LEVEL_DEBUG);
		$cookie = $this->_package();
		setcookie($this->cookiename, $cookie, 0);
		//sfwLogger::log("sfwCookie: set() - all done!", LOGGER_LEVEL_DEBUG);
    }
    
	public function logout()
	{
		//sfwLogger::log("sfwCookie: logout() - resetting cookie", LOGGER_LEVEL_DEBUG);
		setcookie($this->cookiename);
	}
    
	public function validate()
	{
		//sfwLogger::log("sfwCookie: validate() - starting up...", LOGGER_LEVEL_DEBUG);
		if(!$this->version || !$this->created || !$this->userid)
		{
			//sfwLogger::log("sfwCookie: validate() - malformed cookie", LOGGER_LEVEL_DEBUG);
			throw new sfwAuthenticationException(LANG_COOKIE_ERROR_MALCOOKIE);
		}
		if ($this->version != $this->myversion)
		{
			//sfwLogger::log("sfwCookie: validate() - bad cookie version", LOGGER_LEVEL_DEBUG);
			throw new sfwAuthenticationException(LANG_COOKIE_ERROR_VERCOOKIE);
		}
		if (time() - $this->created > $this->expiration)
		{
			//sfwLogger::log("sfwCookie: validate() - cookie expired", LOGGER_LEVEL_DEBUG);
			throw new sfwAuthenticationException(LANG_COOKIE_ERROR_EXPCOOKIE);
		}

		$this->set();
	}
	
	public function currentUserId()
	{
		return $this->userid;
	}

	private function _package()
	{
		$parts = array($this->myversion, time(), $this->userid);
		$cookie = implode($this->glue, $parts);
		//sfwLogger::log("sfwCookie: _package() - packing cookie: ".$cookie, LOGGER_LEVEL_DEBUG);
		$enccookie = sfwEncryption::encrypt($cookie);
		return urlencode(base64_encode($enccookie));
		//return $cookie;
	}
    
	private function _unpackage($cookie)
	{
		//sfwLogger::log("sfwCookie: _unpackage() - starting up...", LOGGER_LEVEL_DEBUG);
		if(empty($cookie))
		{
			//sfwLogger::log("sfwCookie: _unpackage() - cookie's empty'", LOGGER_LEVEL_DEBUG);
			throw new sfwAuthenticationException(LANG_COOKIE_ERROR_RESET);
		}
		
		//sfwLogger::log("sfwCookie: _unpackage() - encrypted cookie: ".$cookie, LOGGER_LEVEL_DEBUG);
		$buffer = sfwEncryption::decrypt(base64_decode(urldecode($cookie)));
		//$buffer = $cookie;
		//sfwLogger::log("sfwCookie: _unpackage() - cookie buffer: ".$buffer, LOGGER_LEVEL_DEBUG);
		list($this->version, $this->created, $this->userid) = explode($this->glue, $buffer);
		if($this->version != $this->myversion ||
			!$this->created ||
			!$this->userid) 
		{
			//sfwLogger::log("sfwCookie: _unpackage() - problem with cookie", LOGGER_LEVEL_WARNING);
			//sfwLogger::log("****** cookie version: ".$this->version, LOGGER_LEVEL_WARNING);
			//sfwLogger::log("****** my version: ".$this->myversion, LOGGER_LEVEL_WARNING);
			//sfwLogger::log("****** created: ".$this->created, LOGGER_LEVEL_WARNING);
			//sfwLogger::log("****** userid: ".$this->userid, LOGGER_LEVEL_WARNING);
			throw new sfwAuthenticationException("Something's amiss in the cookie");
		}
    }

	private function _reissue()
	{
		//sfwLogger::log("sfwCookie: _unpackage() - _reissue()", LOGGER_LEVEL_DEBUG);
		$this->created = time();
	}
}

?>
