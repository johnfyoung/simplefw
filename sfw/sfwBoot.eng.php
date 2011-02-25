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

	// Data access needs to be in place before each subsystem bootstraps
	
	// DATA ACCESS - handled by EZPDO  ////////////////////////////////////////////////
  require_once(LIB_PATH . '/dao/ezpdo_runtime.php');
  epLoadConfig(CONFIG_PATH . '/daoconfig.xml' );
	
 	
 	// Start logger...
 	require_once SFW_PATH . '/sfwLogger.eng.php';
	sfwLogger::log("**************** BOOTING PAGE *********************", LOGGER_LEVEL_DEBUG);
	sfwLogger::log("sfwBoot: uri = " . $_SERVER["REQUEST_URI"], LOGGER_LEVEL_DEBUG);
	
	// INCLUDES ///////////////////////////////////////////////////////////////////////
	require_once SFW_PATH . '/sfwUtility.eng.php';
	require_once SFW_PATH . '/sfwErrors.eng.php';
	require_once SFW_PATH . '/sfwLanguage.eng.php';
  require_once SFW_PATH . '/sfwTemplaterEngine_Smarty.eng.php';
  require_once SFW_PATH . '/sfwTemplaterEngine_PHP.eng.php';
	require_once SFW_PATH . '/sfwTemplater.eng.php';
	require_once SFW_PATH . '/sfwDAO.eng.php';
	require_once SFW_PATH . '/sfwSessionHandler.eng.php';
	require_once SFW_PATH . '/sfwSecurity.eng.php';
	require_once SFW_PATH . '/sfwAuthentication.eng.php';
	require_once SFW_PATH . '/sfwAuthorization.eng.php';
	require_once SFW_PATH . '/sfwManager.eng.php';
	
	// ERROR HANDLER 
	set_exception_handler('sfwExceptionHandler::uncaught');
	
	sfwTemplater::debug(DEBUG);

 }
 
?>
