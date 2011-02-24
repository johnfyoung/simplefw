<?php
/* $Id: sfwManager.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwManager.php
 * Created on Aug 3, 2007
 * by johnny
 */

class sfwManagerException extends Exception {}

class sfwManager
{
	public static function commitUser(&$user)
	{
		$m = epManager::instance();
		
		$obj = sfwDAO::loadByQuery("sfwUser", "uname='$user->uname'"); 
		
		if(isset($obj))
		{
			// update the vars
			$obj->fname = $user->fname;
			$obj->lname = $user->lname;
			$obj->password = sfwEncryption::encrypt($user->password);
			$obj->email = $user->email;
			$obj->roles = $user->roles;
			
			sfwDAO::store($obj);
		}
		else
		{
			sfwDAO::store($user);
		}
	}
}

?>
