<?php
/* $Id: login.php 22 2009-04-27 21:44:56Z codecrea $
 * login.php
 * Created on Aug 3, 2007
 * by johnny
 */

require_once "../boot.eng.php";

$redirect = isset($_GET['originating_uri']) ? $_GET['originating_uri'] : (isset($_POST['originating_uri']) ? $_POST['originating_uri'] : "index.php");
$submit = isset($_POST['form_login_submit']) ? $_POST['form_login_submit'] : "";
$logout = isset($_GET['logout']) ? $_GET['logout'] : "";
if($submit)
{
	$username = isset($_POST['form_login_username']) ? $_POST['form_login_username'] : "";
    $password = isset($_POST['form_login_password']) ? $_POST['form_login_password'] : "";
    try
    {
		$user = sfwAuthentication::check_credentials($username, $password);
		sfwAuthorization::register($user);
		
		header("Location: $redirect");
		exit;
    }
    catch(sfwAuthenticationException $e)
    {
    	header("Location:login.php?originating_uri=".$redirect."&error=".$e->getMessage());
    }
}
else
{
	sfwTemplater::addTpl("login.tpl");
	sfwTemplater::addCSSFile("css/styles.css");
	sfwTemplater::setTitle("SFW Login");
	sfwTemplater::assign("content_title", "Login to gain access:");
	sfwTemplater::assign("lang_login_username",LANG_LOGIN_LABEL_USERNAME);
	sfwTemplater::assign("lang_login_password",LANG_LOGIN_LABEL_PASSWORD);
	sfwTemplater::assign("redirect", $redirect);
	sfwTemplater::assign("error", isset($_GET["error"]) ? $_GET["error"] : "");
}

if($logout)
{
	sfwAuthentication::logout();
	header("Location:index.php");
}
sfwTemplater::display();
?>
