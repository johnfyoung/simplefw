<?php
/* $Id: admin_users.php 22 2009-04-27 21:44:56Z codecrea $
 * admin_users.php
 * Created on Aug 5, 2007
 * by johnny
 */

require_once 'sfw/sfwBoot.eng.php';

sfwAuthorization::grantCurrent(sfwAuthorization::getRole('admin'));

if(sfwAuthorization::check_perm())
{
	$action = isset($_POST["action"]) ? $_POST["action"] : (isset($_GET["action"]) ? $_GET["action"] : ""); 
	
	switch($action)
	{
		case "adduser":
			$uservars = array();
			if(isset($_POST["uname"]))
			{			
				$uservars['uname']  = sfwSecurity::sanitizeText($_POST["uname"]);
			}
	
			if(isset($_POST["fname"]))
			{			
				$uservars['fname']  = sfwSecurity::sanitizeText($_POST["fname"]);
			}
			
			if(isset($_POST["lname"]))
			{			
				$uservars['lname']  = sfwSecurity::sanitizeText($_POST["lname"]);
			}
			
			if(isset($_POST["password"]))
			{			
				$uservars['password']  = sfwSecurity::sanitizeText($_POST["password"]);
			}
			
			if(isset($_POST["email"]))
			{			
				$uservars['email']  = sfwSecurity::sanitizeText($_POST["email"]);
			}
			
			if(isset($_POST["nick"]))
			{			
				$uservars['nick']  = sfwSecurity::sanitizeText($_POST["nick"]);
			}
			
			try
			{
				$newuser = sfwUser::addUser($uservars);
				sfwRole::assign("admin", $newuser);
				sfwTemplater::assign("user_msg", ADMIN_USERS_CONTENT_ADDUSERCONFIRM);	
			}
			catch(Exception $e)
			{
				sfwTemplater::assign("user_msg", ADMIN_USERS_CONTENT_ADDUSERERRORS);
				sfwTemplater::assign("error", $e);
			}
			defaultDisplay();
			break;
		case "get":
			$userid = isset($_GET["userid"]) ? $_GET["userid"] : "";
			if(!empty($userid))
			{
				sfwTemplater::assign("user", sfwDAO::loadByORMID("sfwUser", $userid));
				sfwTemplater::assign("userid", $userid);
				displayUserForm();
				sfwTemplater::addTpl('admin_users_item.tpl');
				sfwTemplater::addCSSFile('css/styles.css');
				sfwTemplater::addJSFile('js/formvalidation.js');
				sfwTemplater::assign('welcome_msg', ADMIN_USERS_CONTENT_MSG);
				sfwTemplater::assign('content_title', ADMIN_USERS_CONTENT_EDITUSER_TITLE);
				sfwTemplater::setTitle(ADMIN_USERS_CONTENT_EDITUSER_TITLE);
				sfwTemplater::assign("userform_label_title", ADMIN_USERS_CONTENT_EDITUSER);
			}
			else
			{
				sfwTemplater::assign("error", ADMIN_USERS_CONTENT_USERNOEXIST);
				defaultDisplay();
			}
			break;
		case "edit":
			$uservars = array();
			if(isset($_POST["userid"]))
			{			
				$uservars['id']  = sfwSecurity::sanitizeText($_POST["userid"]);
			}
			
			if(isset($_POST["uname"]))
			{			
				$uservars['uname']  = sfwSecurity::sanitizeText($_POST["uname"]);
			}
	
			if(isset($_POST["fname"]))
			{			
				$uservars['fname']  = sfwSecurity::sanitizeText($_POST["fname"]);
			}
			
			if(isset($_POST["lname"]))
			{			
				$uservars['lname']  = sfwSecurity::sanitizeText($_POST["lname"]);
			}
			
			if(!empty($_POST["password"]))
			{			
				sfwTemplater::dbgVal("passwordset", "you got it");
				$uservars['password']  = sfwSecurity::sanitizeText($_POST["password"]);
			}
			else if(isset($_POST["oldpassword"]))
			{
				$uservars['password']  = sfwEncryption::decrypt($_POST["oldpassword"]);
			}
			else
			{
			sfwTemplater::dbgVal("passwordnotset", "you got it");	
			}
			
			sfwTemplater::dbgVal("password", $uservars['password']);
			
			if(isset($_POST["email"]))
			{			
				$uservars['email']  = sfwSecurity::sanitizeText($_POST["email"]);
			}
			
			if(isset($_POST["nick"]))
			{			
				$uservars['nick']  = sfwSecurity::sanitizeText($_POST["nick"]);
			}
			
			try
			{
				sfwUser::modifyUser($uservars);
				sfwTemplater::assign("user_msg", ADMIN_USERS_CONTENT_EDITUSERCONFIRM);	
			}
			catch(Exception $e)
			{
				sfwTemplater::assign("user_msg", ADMIN_USERS_CONTENT_EDITUSERERRORS);
				sfwTemplater::assign("error", $e);
			}
			defaultDisplay();
			break;
		default:
			defaultDisplay();
	}
}
else
{
	sfwTemplater::addTpl('restricted.tpl');
	sfwTemplater::assign('msg', LANG_AUTH_FAILURE_NOTALLOWED);
}

sfwTemplater::display();

function displayUserList()
{
	sfwTemplater::assign("userform_label_inputrequired", ADMIN_USERS_CONTENT_INPUTREQUIRED);
	sfwTemplater::assign("userlist_label_title", ADMIN_USERS_CONTENT_USERLIST);
	sfwTemplater::assign("userlist_label_uname", ADMIN_USERS_CONTENT_UNAME);
	sfwTemplater::assign("userlist_label_fname", ADMIN_USERS_CONTENT_FNAME);
	sfwTemplater::assign("userlist_label_lname", ADMIN_USERS_CONTENT_LNAME);
	sfwTemplater::assign("userlist_label_email", ADMIN_USERS_CONTENT_EMAIL);
	sfwTemplater::assign("userlist_label_nick", ADMIN_USERS_CONTENT_NICK);
	sfwTemplater::assign("userlist_label_action", ADMIN_CONTENT_ACTION);
	
	$users = sfwUser::userList();
	if(!empty($users))
	{
		sfwTemplater::assign("users", sfwUser::userList());
	}
	else
	{
		sfwTemplater::assign("userlist_msg_nousers", ADMIN_USERS_CONTENT_NOUSERS);
	}	
}

function displayUserForm()
{
	sfwTemplater::assign("userform_label_uname", ADMIN_USERS_CONTENT_UNAME);
	sfwTemplater::assign("userform_label_fname", ADMIN_USERS_CONTENT_FNAME);
	sfwTemplater::assign("userform_label_lname", ADMIN_USERS_CONTENT_LNAME);
	sfwTemplater::assign("userform_label_email", ADMIN_USERS_CONTENT_EMAIL);
	sfwTemplater::assign("userform_label_password", ADMIN_USERS_CONTENT_PASSWORD);
	sfwTemplater::assign("userform_label_passwordconfirm", ADMIN_USERS_CONTENT_PASSWORDCONFIRM);
	sfwTemplater::assign("userform_label_nick", ADMIN_USERS_CONTENT_NICK);
	sfwTemplater::assign("submit", LANG_LABEL_SUBMIT);
}

function defaultDisplay()
{
	sfwTemplater::addTpl('admin_users.tpl');
	sfwTemplater::addCSSFile('css/styles.css');
	sfwTemplater::addJSFile('js/formvalidation.js');
	sfwTemplater::assign('welcome_msg', ADMIN_USERS_CONTENT_MSG);
	sfwTemplater::assign('logout_href', "login.php?logout=1");
	sfwTemplater::assign('content_title', ADMIN_USERS_CONTENT_TITLE);
	sfwTemplater::setTitle(ADMIN_USERS_CONTENT_TITLE);
	displayUserForm();
	displayUserList();
	sfwTemplater::assign("userform_label_title", ADMIN_USERS_CONTENT_ADDUSER);
}
 
?>
