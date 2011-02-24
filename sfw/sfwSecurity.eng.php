<?php
/* $Id: sfwSecurity.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfSecurity.php
 * Created on May 31, 2007
 * by johnny
 */
 
/**
 * sfwSecurity - a namespace for security functions
 */
 
 require_once 'lib/inputfilter/class.inputfilter.php';
 
class sfwSecurity
{
	public static function sanitizeText($str)
	{
		$filter = new InputFilter();
		
		return $filter->process($str);
	}
	
	public static function safeMySQL($str)
	{
		return InputFilter::safeSQL($str, sfwDAO::getDB());
	}
}

?>
