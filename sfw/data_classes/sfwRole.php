<?php
/* $Id: sfwRole.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwRole.php
 * Created on Aug 3, 2007
 * by johnny
 */
 
 /**
  * @orm sfwRole
  */
 class sfwRole
 {
 	/**
 	 * @orm char(32) unique(idx_Role_label)
 	 */
 	public $label;
 	
 	/**
 	 * @orm char(256)
 	 */
 	public $description;
 	
 	/**
 	 * @orm has many sfwPermission inverse(roles) 
 	 */
 	public $perms;
 	
 	/**
 	 * @orm has many sfwUser inverse(roles) 
 	 */
 	public $users;
 	
 	
 	public static function get($label)
 	{
 		return sfwDAO::loadByQuery("sfwRole", "label = '".$label."'");
 	}
 	
 	/**
 	 * 
 	 */
 	public static function assign($label, $user)
 	{
 		if(is_obj($user, "sfwUser"))
 		{
	 		$role = self::get($label);
	 		if($role)
	 		{
		 		$role->users[] = $user;
		 		sfwDAO::store($role); 			
	 		}
	 		else
	 		{
	 			throw new Exception("Role doesn't exist");
	 		}
 		}
 		else
 		{
 			throw new sfwTypeException("Can't assign role to non-user type");
 		}
		return true;
 	} 
 }

 
?>
