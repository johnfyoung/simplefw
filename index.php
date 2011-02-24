<?php
/* $Id: index.php 22 2009-04-27 21:44:56Z codecrea $
 * index.php
 * Created on May 30, 2007
 * by johnny
 */

require_once 'sfw/sfwBoot.eng.php';

sfwTemplater::setTitle(MAIN_CONTENT_TITLE);
sfwTemplater::addTpl('main.tpl');
sfwTemplater::addCSSFile('css/styles.css');
sfwTemplater::assign('content_title', MAIN_CONTENT_TITLE);

$user = sfwAuthorization::currentUser(); 

if($user)
{
	sfwTemplater::assign('welcome_msg', MAIN_CONTENT_USERSALUTATION . $user->fname ." ".$user->lname);
	if($user->hasRole('admin'))
	{
		sfwTemplater::assign('link', "admin.php");
		sfwTemplater::assign('link_label', MAIN_CONTENT_ADMINLINK);
	}
	sfwTemplater::assign('logout_link_label', LANG_LOGOUT_LABEL);
	sfwTemplater::assign("logout_link", URL_PATHTOFILE . "/login.php?logout=1");
}
else
{
	sfwTemplater::assign('welcome_msg', MAIN_CONTENT_MSG);
	sfwTemplater::assign('link_label', LANG_LOGIN_LABEL);
	sfwTemplater::assign('link', URL_PATHTOFILE . "/login.php");
}

sfwTemplater::display();
?>
