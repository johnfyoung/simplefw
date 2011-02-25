<?php
/* $Id: admin.php 22 2009-04-27 21:44:56Z codecrea $
 * admin_test.php
 * Created on Aug 1, 2007
 * by johnny
 */
 
require_once "../boot.eng.php";

sfwAuthorization::grantCurrent(sfwAuthorization::getRole('admin'));

if(sfwAuthorization::check_perm())
{
	sfwTemplater::addTpl('admin.tpl');
	sfwTemplater::addCSSFile('css/styles.css');
	sfwTemplater::assign('welcome_msg', ADMIN_CONTENT_MSG);
	sfwTemplater::assign('logout_href', "login.php?logout=1");
	sfwTemplater::assign('content_title', ADMIN_CONTENT_TITLE);
	sfwTemplater::setTitle(ADMIN_CONTENT_TITLE);
	sfwTemplater::assign('tasks', array(array("label"=>ADMIN_CONTENT_TASK_USERS, "url"=>URL_PATHTOFILE."/admin_users.php")));
}
else
{
	sfwTemplater::addTpl('restricted.tpl');
	sfwTemplater::assign('msg', LANG_AUTH_FAILURE_NOTALLOWED);
}

sfwTemplater::display(); 
?>
