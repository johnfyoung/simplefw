<?php
/* $Id: sfwDAO.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwDAO.php
 * Created on May 30, 2007
 * by johnny
 */
 
/**
 * sfwDAO - Class for accessing Data Access Objects
 * 
 * can be delegated to by wrapper class (e.g., sfwMyClassFactory delegate to sfwDAO)
 * 
 * The current Data Engine (EZPDO) offers simple syntax.  But to insulate the rest of the
 * framework from the data engine, the DAOFactory wraps that functionality (while trying to 
 * do some type checking) 
 * 
 * @author johnny
 * @todo add batch processing functions
 */
 // TODO add batch processing functions
class sfwDAO
{	
	public static function getDB()
	{
		$m = epManager::instance();
		return $m->getDb($m->getClassMap("sfwUser"))->connection();
	}
	
	public static function load($obj)
	{
		$m = epManager::instance();
		return $m->find($obj);
	}
	
	/**
	 * retrieve an object from persistent storage by unique id
	 * @author johnny
	 * @param string type the ORM class to access
	 * @param int id the unique id of the object
	 * @return array member items in an indexed array
	 */
	public static function loadByORMID($type, $id)
	{
		$m = epManager :: instance();
		$objs = null;
		try
		{
			$objs = $m->query("FROM ". $type . " WHERE oid = ". $id);
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::h("sfwDAO: loadByORMID()", $e);
		}
		
		if($objs)
		{
			$objValues = array_values($objs);
			return $objValues[0];
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * retrieve a set of objects from persistent storage
	 * @author johnny
	 * @access public
	 * @param string type the ORM class to access
	 * @param string condition SQL for a where clause (w/o the where)
	 * @param string orderBy table field by which to order the result
	 * @return array the result or null if recieve the empty set
	 * @todo make sure the query params are sanitized
	 */
	public static function listByQuery($type, $condition, $orderBy=null)
	{
		// TODO make sure query params are sanitized
		$m = epManager :: instance();
		$sql = "FROM " . $type;
		if(!is_null($condition))
		{
			$sql .= " WHERE " . stripslashes($condition);
		}
    
		if(!is_null($orderBy))
		{
			$sql .= " order by " . $orderBy;
		}
    	
    	//sfwLogger::log("sfwDAO: listByQuery() - sql = ". $sql);
    	
    	$objs = null;
		try
		{
			$cm = null;
			$cm = $m->getClassMap($type);
			
			//sfwLogger::log("sfwDAO: listByQuery() - get class map = " . (!empty($cm) ? "yep" : "nope"));
			if($m->getClassMap($type))
			{
				$objs = $m->query($sql);
			}
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::h("sfwDAO:: listByQuery()", $e);
		}
		
		if($objs != null && count($objs))
		{
			return $objs;
		}
		return null;
		
	}

	/**
	 * retrieve an object from persistent storage using an SQL where clause
	 * @author johnny
	 * @access public
	 * @param string type the ORM class to access
	 * @param string condition SQL for a where clause (w/o the where)
	 * @param string orderBy table field by which to order the result
	 * @return array object's members as an indexed array or null if empty set
	 */
	public static function loadByQuery($type, $condition, $orderBy=null)
	{
		$objs = self::listByQuery($type, $condition, $orderBy);
		if(count($objs))
		{
			$objValues = array_values($objs);
			return $objValues[0];
		}
		
		return null;
	}
  
	/**
	 * create an empty object
	 * @author johnny
	 * @access public
	 * @param string type the ORM class to access
	 * @return object creates a default object
	 */
	public static function create($type)
	{
		//sfwLogger::log("sfwDAO: creating ".$type, LOGGER_LEVEL_DEBUG);
		$m = epManager::instance();
		$obj = $m->create($type);
		return $obj;
	}
	
	public static function store($obj)
	{
		$success = false;
		if(!is_obj($obj))
		{
			throw new sfwTypeException(LANG_DAO_ERROR_TYPE);
		}
		
		try
		{
			$success = $obj->commit();
		}
		catch(Exception $e)
		{
			sfwExceptionHandler::h("sfwDAO: store()", $e);
		}

		return $success;
	}
	
	public static function delete(&$obj)
	{
		$success = false;
		if(!is_obj($obj))
		{
			throw new sfwTypeException(LANG_DAO_ERROR_TYPE);
		}
		
		try
		{
			$success = $obj->delete();
		}
		catch (Exception $e)
		{
			echo $e;
		}
		
		return $success;
	}
	
	public static function objID(&$obj)
	{
		if(!is_obj($obj))
		{
			throw new sfwTypeException(LANG_DAO_ERROR_TYPE);
		}
		
		return $obj->getOid();
	}
	
	public static function compare(&$l, &$r)
	{
		if(!is_obj($l) || !is_obj($r))
		{
			throw new sfwTypeException(LANG_DAO_ERROR_TYPE);
		}
		
		return $l->epMatches($r);
	}
}
?>
