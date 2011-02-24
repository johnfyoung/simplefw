<?php
/* $Id: sfwUser.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwUser.php
 * Created on May 29, 2007
 * by johnny
 */
 
 /**
  * @orm sfwUser
  */
 class sfwUser
 {
 	/**
 	 * @orm uname char(32) unique(idx_User_uname)
 	 */
 	public $uname;
 	 
	/**
	 * @orm email char(64)
	 */
 	public $email;
 	
 	/**
 	 * @orm char(256)
 	 */
 	public $password;
 	
 	/**
 	 * @orm char(32)
 	 */
 	public $fname;
 	
 	/**
 	 * @orm char(32)
 	 */
 	public $lname;
 	
 	/**
 	 * @orm char(32)
 	 */
 	public $nick;
 	
 	/**
 	 * @orm has many sfwRole inverse(users) 
 	 */
 	public $roles;
 	
 	public function hasRole($role)
 	{
 		if(is_string($role))
 		{
 			$role = sfwAuthorization::getRole($role);
 		}
 		
 		if(is_obj($role, 'sfwRole'))
 		{
 			foreach($this->roles as $r)
 			{
 				if(sfwDAO::compare($r,$role))
				{
					return true;
				}
 			}	
 		}
 		
 		return false;
 	}
 	
 	public static function userList()
 	{
    	$retval = null;
    	$items = sfwDAO::listByQuery("sfwUser", null);
    	
    	if(!empty($items))
    	{
    		$retval = array();
    		foreach($items as $i)
    		{
    			$retval[sfwDAO::objID($i)] = $i;
    		}
    	}

		return $retval;
 	}
 	
 	public static function addUser($vars)
 	{
 		$user = null;
 		if(is_array($vars))
 		{
			$user = sfwDAO::create("sfwUser");
			if(isset($vars["uname"]))
			{			
				if(!sfwUser::isUniqueUserName(isset($vars["uname"])))
				{
					throw new sfwBadInputException("User Name already in use");
				}
				$user->uname = $vars["uname"];
			}
			else
			{
				throw new sfwBadInputException("User Name is Empty");
			}
	
			if(isset($vars["fname"]))
			{			
				$user->fname  = $vars["fname"];
			}
			else
			{
				throw new sfwBadInputException("First Name is Empty");
			}
			
			if(isset($vars["lname"]))
			{			
				$user->lname  = $vars["lname"];
			}
			else
			{
				throw new sfwBadInputException("Last Name is Empty");
			}
			
			if(isset($vars["password"]))
			{			
				$user->password  = sfwEncryption::encrypt($vars["password"]);
			}
			else
			{
				throw new sfwBadInputException("Password is empty");
			}
			
			if(isset($vars["email"]))
			{			
				$user->email  = $vars["email"];
			}
			else
			{
				throw new sfwBadInputException("Email address is Empty");
			}
			
			if(isset($vars["nick"]))
			{			
				$user->nick  = $vars['nick'];
			}
			
			sfwDAO::store($user);
 		}
 		
 		return $user;
 	}
 	
 	public static function modifyUser($vars)
 	{
 		$user = null;
 		if(is_array($vars))
 		{
			$user = sfwDAO::loadByORMID("sfwUser", $vars["id"]);
			
			if(!$user)
			{
				throw new sfwBadInputException("User doesn't exist'");
			}
			
			if(isset($vars["uname"]))
			{			
				if(!sfwUser::isUniqueUserName(isset($vars["uname"])))
				{
					throw new sfwBadInputException("User Name already in use");
				}
				$user->uname = $vars["uname"];
			}
			else
			{
				throw new sfwBadInputException("User Name is Empty");
			}
	
			if(isset($vars["fname"]))
			{			
				$user->fname  = $vars["fname"];
			}
			else
			{
				throw new sfwBadInputException("First Name is Empty");
			}
			
			if(isset($vars["lname"]))
			{			
				$user->lname  = $vars["lname"];
			}
			else
			{
				throw new sfwBadInputException("Last Name is Empty");
			}
			
			if(isset($vars["password"]))
			{			
				$user->password  = sfwEncryption::encrypt($vars["password"]);
			}
			else
			{
				throw new sfwBadInputException("Password is empty");
			}
			
			if(isset($vars["email"]))
			{			
				$user->email  = $vars["email"];
			}
			else
			{
				throw new sfwBadInputException("Email address is Empty");
			}
			
			if(isset($vars["nick"]))
			{			
				$user->nick  = $vars['nick'];
			}
			
			sfwDAO::store($user);
 		}
 		return $user;
 	} 
 	
 	public static function isUniqueUserName($str)
 	{
 		$result = sfwDAO::loadByQuery("sfwUser", "uname = '".$str."'");
 		if($result)
 		{
 			return false;
 		}
 		return true;
 	}
 }
 
?>
