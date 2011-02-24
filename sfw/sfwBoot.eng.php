<?php
/* $Id: sfwBoot.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfBoot.eng.php
 * Created on May 9, 2007
 * by johnny
 */
 
 if(!defined("SFWMAIN"))
 {
 	define("SFWMAIN", true);

	ob_start();
 	
	define("LOGGER_LEVEL_DEBUG", 10);
	define("LOGGER_LEVEL_ERROR", 1);
	define("LOGGER_LEVEL_WARNING", 5);
	define("LOGGER_LEVEL_INFO", 3);
 	
 	// PATH DEFINITION - important paths ////////////////////////////////////////////////
 	define("SFW_PATH", realpath(dirname(__FILE__)));
 	define("ROOT_PATH", realpath(SFW_PATH . '/../'));
 	define("CLASS_PATH", ROOT_PATH . '/data_objects');
 	define("LIB_PATH", SFW_PATH . "/lib");
 	define("LOG_PATH", SFW_PATH . "/logs");
 	
 	require_once SFW_PATH . '/configs/sfw_config.cfg.php';
 	
 	$path_parts = pathinfo($_SERVER["PHP_SELF"]); 	
 	define("URL_PROTOCOL", "http://");
 	define("URL_HOST", $_SERVER["SERVER_NAME"]);
 	
 	$dirname = $path_parts['dirname'];
 	if($dirname[strlen($dirname) - 1] == '/')
 	{
 		$dirname = substr($dirname, 0, strlen($dirname) - 1);
 	}
 	
 	define("URL_PATH", $dirname);
 	
 	define("URL_FILE", $path_parts['basename']);
 	define("URL_QUERY", parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));
 	define("URL_PATHTOFILE", URL_PROTOCOL.URL_HOST.URL_PATH);
 	
	// LANGUAGE SETTING - choose a language folder //////////////////////////////////////
	define("LANG", "en");
	define("LANG_PATH", ROOT_PATH . '/language/' . LANG);
	define("LANG_PATH_SF", SFW_PATH . '/language/' . LANG);
	define("LANG_PATH_CLASS", CLASS_PATH . '/language/' . LANG);

	// DATA ACCESS - handled by EZPDO  ////////////////////////////////////////////////
 	require_once SFW_PATH . '/dao/orm.php';
 	
 	// Start logger...
 	require_once SFW_PATH . '/sfwLogger.eng.php';
	sfwLogger::log("**************** BOOTING PAGE *********************", LOGGER_LEVEL_DEBUG);
	sfwLogger::log("sfwBoot: uri = " . $_SERVER["REQUEST_URI"], LOGGER_LEVEL_DEBUG);
	
	// INCLUDES ///////////////////////////////////////////////////////////////////////
	require_once SFW_PATH . '/sfwUtility.eng.php';
	require_once SFW_PATH . '/sfwErrors.eng.php';
	require_once SFW_PATH . '/sfwLanguage.eng.php';
	require_once SFW_PATH . '/sfwTemplater.eng.php';
	require_once SFW_PATH . '/sfwDAO.eng.php';
	require_once SFW_PATH . '/sfwSessionHandler.eng.php';
	require_once SFW_PATH . '/sfwSecurity.eng.php';
	require_once SFW_PATH . '/sfwAuthentication.eng.php';
	require_once SFW_PATH . '/sfwAuthorization.eng.php';
	require_once SFW_PATH . '/sfwManager.eng.php';
	
	// ERROR HANDLER 
	set_exception_handler('sfwExceptionHandler::uncaught');
	
	sfwTemplater::debug(false);
 }
 
?>
