<?php
/* $Id: sfwSession.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwSession.php
 * Created on Aug 1, 2007
 * by johnny
 */
 
class sfwSession
{	 
	/**
	 * @orm sess_id char(256) unique(idx_Session_ID)
	 */
	public $sess_id;
	
	/**
	 * @orm data char(256)
	 */
	public $data;
	
	/**
	 * @orm createtime datetime
	 */
	public $createtime;
	
	/**
	 * @orm modtime datetime
	 */
	public $modtime;
	
	/**
	 * @orm user int
	 */
	public $user;
	
}
?>
