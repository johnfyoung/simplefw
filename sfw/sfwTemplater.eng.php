<?php
/* $Id: sfwTemplater.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwTemplater.eng.php
 * Created on Jul 24, 2007
 * by johnny
 */
 
define("SFW_TPLS", "file:" . SFW_PATH . "/templates");

// TODO fix the js include - it needs a url path not physical path

class sfwTemplater
{
	/**
	 * the Singleton instance
	 */
	protected static $_instance;
	
	/**
	 * Template Engine
	 */
	protected static $_engine;
	
	/**
	 * array of .tpl files
	 */
	protected static $_templates;
	
	/**
	 * array of .js files to be included in the page head 
	 */
	protected static $_tpl_head_javascript;
	
	/**
	 * array of .js files to be included at the end of the page body
	 */
	protected static $_tpl_foot_javascript;
	
	/**
	 * array of .css files to be included in the page head
	 */
	protected static $_tpl_head_css;
	
	/**
	 * the page title
	 */
	protected static $_tpl_head_title;
	
	/**
	 * array of meta tags to be written into the page head
	 * array is formatted like so:
	 * [name1 => [tag1, tag2, ...], name2=>[tag1, tag2, ...], ...]
	 */
	protected static $_tpl_head_meta;
	
	protected static $_tpl_body_tags;

	protected static $_tpl_debug_vals;
	
	protected function __construct()
	{
		$this->_tpl_head_javascript = array();
		$this->_tpl_foot_javascript = array();
		$this->_tpl_head_css = array();
		$this->_tpl_head_meta = array();
		$this->_templates = array();
		$this->_templates[] = SFW_TPLS . "/page_head.tpl";
		$this->_tpl_head_title = "Page Title Goes Here";
		$this->_tpl_body_tags = array();
		$this->_tpl_debug_val = array();
		
	  switch(TEMPLATE_ENGINE)
    {
      case 'php':
        $this->_engine = new sfwTemplaterEngine_PHP();
        break;
      case 'smarty':
        $this->_engine = new sfwTemplaterEngine_Smarty();
        break;      	
      default:
        $this->_engine = new sfwTemplaterEngine_PHP();      	
    }
	}
	
	public static function getInstance()
	{
		if(!isset(self::$_instance))
		{
			self::$_instance = new sfwTemplater();
		}
		
		return self::$_instance;
	}
	
	public static function debug($debug)
	{
		$t = self::getInstance();
		$t->_engine->debug($debug);
		
	}
	
	public static function addJSFile($filepath, $isHead = true)
	{
		if($isHead)
		{
			self::$_tpl_head_javascript[] = array("type"=>"file", "data"=>$filepath);
		}
		else
		{
			self::$_tpl_foot_javascript[] = array("type"=>"file", "data"=>$filepath);
		}
	}
	
	public static function addJS($src, $isHead = true)
	{
		if($isHead)
		{
			self::$_tpl_head_javascript[] = array("type"=>"script", "data"=>$src);
		}
		else
		{
			self::$_tpl_foot_javascript[] = array("type"=>"script", "data"=>$src);
		}
	}
	
	public static function addCSSFile($filepath)
	{
		self::$_tpl_head_css[] = $filepath;
	}
	
	public static function addMetaTag($name, $content)
	{
		if(is_array($content))
		{
			self::$_tpl_head_meta[$name] = $content;
		}
		else
		{
			self::$_tpl_head_meta[$name] = array($content);
		}
	}
	
	public static function appendToMetaTag($name, $content)
	{
		if(isset(self::$_tpl_head_meta[$name]))
		{
			if(is_array($content))
			{
				self::$_tpl_head_meta[$name] = array_merge(self::$_tpl_head_meta[$name],$content);
			}
			else
			{
				self::$_tpl_head_meta[$name][] = $content;
			}
		}
		else
		{
			self::addMetaTag($name, $content);
		}
	}	
	
	public static function setTitle($title)
	{
		self::$_tpl_head_title = $title;
	}
	
	public static function setBodyTag($name, $content)
	{
		if(is_array($content))
		{
			self::$_tpl_body_tags[$name] = $content;
		}
		else
		{
			self::$_tpl_body_tags[$name] = array($content);
		}
	}
	
	public static function appendToBodyTag($name, $content)
	{
		if(isset(self::$_tpl_body_tags[$name]))
		{
			if(is_array($content))
			{
				self::$_tpl_body_tags[$name] = array_merge(self::$_tpl_body_tags[$name],$content);
			}
			else
			{
				self::$_tpl_body_tags[$name][] = $content;
			}
		}
		else
		{
			self::setBodyTag($name, $content);
		}
	}	
	
	public static function setBodyId($id)
	{
		self::setBodyTag("id", $id);
	}
	
	public static function setBodyClass($class)
	{
		self::setBodyTag("class", $class);
	}
	
	public static function appendToBodyClass($class)
	{
		self::appendToBodyTag("class", $class);
	}
	
	public static function setBodyOnload($script)
	{
		self::setBodyTag("onload", $script);
	}
	
	public static function appendToBodyOnload($script)
	{
		self::appendToBodyTag("onload", $script);
	}
	
	public static function head_js()
	{
		return self::_renderJS(self::$_tpl_head_javascript);
	}
	
	public static function foot_js()
	{
		return self::_renderJS(self::$_tpl_foot_javascript);
	}
	
	private static function _renderJS($jsitems)
	{
		// <script type="text/javascript" src="{$hjs_file}"></script>
		$str = "";
		if(isset($jsitems[0]))
		{
			foreach($jsitems as $js)
			{
				if($js["type"] == "file")
				{
					$str .= "<script type='text/javascript' src='" . $js["data"] ."' ></script>\n";
				}
				elseif($js["type"] == "script")
				{
					$str .= "<script type='text/javascript'>\n" . $js["data"] ."\n</script>\n";
				}
			}
		}
		return $str;
	}
	
	public static function head_css()
	{
		// <link rel="stylesheet" type="text/css" href="{$hcss_file}" />
		$str = "";
		if(isset(self::$_tpl_head_css[0]))
		{
			foreach(self::$_tpl_head_css as $cssfile)
			{
				$str .= "<link rel='stylesheet' type='text/css' href='" . $cssfile ."' />\n";
			}
		}
		return $str;
	}
	
	public static function head_title()
	{
		$str = "";
		if(isset(self::$_tpl_head_title))
		{
			$str .= "<title>" . self::$_tpl_head_title ."</title>\n";
		}
		return $str;
	}
	
	public static function head_meta()
	{
		$str = "";
		if(isset(self::$_tpl_head_meta[0]))
		{
			foreach(self::$_tpl_head_meta as $key => $val)
			{
				$str .= "<meta name='" . $key ."' content='";
				if(is_array($val))
				{
					$i = 0;
					foreach($val as $v)
					{
						$str .= $v;
						if($i < count($val) - 1)
						{
							$str .= ",";
						}
						$i++;
					}	
				}
				else
				{
					$str .= $val;
				}
				$str .= "' />\n";
			}
		}
		return $str;
	}
	
	public static function body_id()
	{
		return self::body_tags("id");
	}

	public static function body_class()
	{
		return self::body_tags("class");
	}
	
	public static function body_onload()
	{
		return self::body_tags("onload");
	}
	
	public static function body_tags($name = false)
	{
		$str = "";
		if($name == false)
		{
			if(!empty(self::$_tpl_body_tags))
			{
				$i = 0;
				foreach(self::$_tpl_body_tags as $key => $val)
				{
					if($key != "id" && $key != "class" && $key != "onload")
					{
						$i != 0 ? $str .= " " : "";
						$str .= self::_compose_tag($key);
						$i++;
					}
				}
			}
		}
		else
		{
			$str .= self::_compose_tag($name);
		}
		
		return $str;
	}
	
	private static function _compose_tag($name)
	{
		$str = "";
		if(!empty($name) && isset(self::$_tpl_body_tags[$name]))
		{
			$tagval = self::$_tpl_body_tags[$name];

			$str .= $name . "='";
			$i = 0;
			foreach($tagval as $v)
			{
				$i != 0 ? $str .= " " : "";
				$str .= $v;
				$i++;
			}
			$str .= "'";
		}
		return $str;
	}
	
	public static function addTpl($filepath)
	{
		$t = sfwTemplater::getInstance();
		$t->_templates[] = $filepath;
	}
	
	public static function assign($var, $val)
	{
		$t = sfwTemplater::getInstance();
		$t->_engine->assign($var, $val);
	}
	
	public static function display()
	{
    $t = sfwTemplater::getInstance();
    $t->_engine->assign('head_js', sfwTemplater::head_js());
    $t->_engine->assign('head_css', sfwTemplater::head_css());
    $t->_engine->assign('foot_js', sfwTemplater::foot_js());
    $t->_engine->assign('head_title', sfwTemplater::head_title());
    $t->_engine->assign('head_meta', sfwTemplater::head_meta());
    $t->_engine->assign('body_id', sfwTemplater::body_id());
    $t->_engine->assign('body_class', sfwTemplater::body_class());
    $t->_engine->assign('body_tags', sfwTemplater::body_tags());
    $t->_engine->assign('body_onload', sfwTemplater::body_onload());
    
    foreach($t->_templates as $tpl)
    {
      $t->_engine->display($tpl);
    }
    
    if(!empty($t->_tpl_debug_vals))
    {
      $t->_engine->assign("sfw_debug", $t->_tpl_debug_vals);
      $t->_engine->display(SFW_TPLS . '/page_debug.tpl');
    }
    
    $t->_engine->display(SFW_TPLS . '/page_foot.tpl');
    ob_end_flush();
    sfwLogger::log("sfwTemplater_Smarty: done displaying! ******************" ,LOGGER_LEVEL_DEBUG);
	}
	
	public static function dbgVal($key, $val)
	{
		$t = self::getInstance();
		$t->_tpl_debug_vals[$key] = $val; 
	}
}

  // Init Template Engine
  $sfwT = sfwTemplater::getInstance();
  sfwTemplater::addJSFile(URL_PROTOCOL. URL_HOST . URL_ROOT . "/sfw/lib/js/scriptaculous/prototype.js");
  sfwTemplater::addJSFile(URL_PROTOCOL. URL_HOST . URL_ROOT . "/sfw/lib/js/scriptaculous/scriptaculous.js");
  sfwTemplater::assign("_ROOTURL_", URL_ROOT);
 
?>
