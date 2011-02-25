<?php
//$Id$
/**
 * @file
 *
 * @author
 */


// Set the Application's location
define("APPLICATION_PATH", realpath(dirname(__FILE__)));

// Set the configs location
define("CONFIG_PATH", APPLICATION_PATH . '/../config');

// Define system variables
require_once(APPLICATION_PATH . '/../sfw/sfwDefinitions.eng.php');

// Get User Configurations
require_once(CONFIG_PATH . '/sfw_config.cfg.php');

// Startup system
require_once(SFW_PATH . '/sfwBoot.eng.php');

?>
