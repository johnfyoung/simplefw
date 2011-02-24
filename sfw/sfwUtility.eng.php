<?php
/* $Id: sfwUtility.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwUtility.eng.php
 * Created on May 24, 2007
 * by johnny
 */

/**
 * Type checking function
 * @param object obj reference to the object to test
 * @param string type class name to check for
 * @param bool strict case sensitive type name or not (default is true)
 * @return boolean whether the object is of the specified type
 */
function is_obj( &$obj, $type=null, $strict=true )
{
	//echo "checking object <br />";
    if( $type == null && is_object($obj) )
    {
        return true;
    }
    if( is_object($obj) )
    {
        $object_name = $obj->epGetClass();
        if( $strict === true )
        {
            if( $object_name == $type )
            {
                return true;
            }
        }
        else
        {
            if( strtolower($object_name) == strtolower($type) )
            {
                return true;
            }
        }
    }
}

/**
 * looks for \', replaces with '
 */
function cleanSingleQuotes($str)
{
	$re = "/\\\'/";
	$replace = "'";
	$result = preg_replace($re, $replace, $str);
	return $result;
}

?>
