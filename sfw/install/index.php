<?php
/* $Id: index.php 22 2009-04-27 21:44:56Z codecrea $
 * index.php
 * Created on Aug 3, 2007
 * by johnny
 */
 
require_once "../sfwBoot.eng.php";

// TODO installer

$errors = array();

// create admin user
$obj = sfwDAO::loadByQuery("sfwUser", "uname = 'admin'");

$message = "";

if(!$obj)
{
	$adminuser = sfwDAO::create("sfwUser");
	$adminuser->uname = "admin";
	$adminuser->fname = "Administrative";
	$adminuser->lname = "Person";
	$adminuser->email = "john@codeandcreative.com";
	$adminuser->password = sfwEncryption::encrypt("password");
	$adminuser->nick = "admin";
	
	$adminrole = sfwDAO::create("sfwRole");
	$adminrole->label = "admin";
	$adminrole->description = "Shaka Zulu!";
	$anonrole = sfwDAO::create("sfwRole");
	$anonrole->label = "anonymous";
	$anonrole->description = "Stranger";
	sfwDAO::store($anonrole);
	
	$adminrole->users[] = $adminuser;
	
	sfwManager::commitUser($adminuser);
	$message = "SFW Installed!";
}
else
{
	//already installed
	$message = "SFW is already installed";
}

sfwTemplater::addTpl("file:". SFW_PATH ."/install/install.tpl");
sfwTemplater::assign("message", $message);

sfwTemplater::display();

?>
