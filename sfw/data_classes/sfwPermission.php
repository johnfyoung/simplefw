<?php
/* $Id: sfwPermission.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwPermission.php
 * Created on Aug 1, 2007
 * by johnny
 */
 
 /**
  * @orm sfwPermission
  */
 class sfwPermission
 {
 	/**
	 * @orm char(5000) unique(idx_Permission_url)
	 */
	public $url;
	 
	/**
	 * @orm char(128)
	 */
	public $label;
	
	/**
	 * @orm char(255)
	 */
	public $description;
	
	/**
	 * @orm has many sfwRole inverse(perms)
	 */
	public $roles;
}
 
?>
