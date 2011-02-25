<?php
//$Id$
/**
 * @file
 *
 * @author
 */

  define("LOGGER_LEVEL_DEBUG", 10);
  define("LOGGER_LEVEL_ERROR", 1);
  define("LOGGER_LEVEL_WARNING", 5);
  define("LOGGER_LEVEL_INFO", 3);
  
  // PATH DEFINITION - important paths ////////////////////////////////////////////////
  define("SFW_PATH", realpath(dirname(__FILE__)));
  define("CLASS_PATH", APPLICATION_PATH . '/data_classes');
  define("LIB_PATH", SFW_PATH . "/lib");
  define("LOG_PATH", SFW_PATH . "/logs");

  $path_parts = pathinfo($_SERVER["PHP_SELF"]);   
  define("URL_PROTOCOL", "http://");
  define("URL_HOST", $_SERVER["SERVER_NAME"]);
  
  $dirname = $path_parts['dirname'];
  
  // remove trailing slash
  if($dirname[strlen($dirname) - 1] == '/')
  {
    $dirname = substr($dirname, 0, strlen($dirname) - 1);
  }
  
  // url path should be relative to the control folder
  $dirname = str_replace("/application/control", "", $dirname);
  
  define("URL_PATH", $dirname);
  define("URL_FILE", $path_parts['basename']);
  define("URL_QUERY", parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));
  define("URL_PATHTOFILE", URL_PROTOCOL.URL_HOST.URL_PATH);
  
  //echo '<pre>'.print_r($path_parts, 1).'</pre>';
  //echo '<pre>'.$_SERVER["SERVER_NAME"].'</pre>';
  
  //echo '<pre>'.str_replace("/application/control", "", $dirname) .'</pre>';
?>
