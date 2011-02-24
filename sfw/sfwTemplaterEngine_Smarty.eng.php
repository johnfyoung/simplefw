<?php
//$Id$
/**
 * @file
 *
 * @author
 */

require_once SFW_PATH . '/lib/smarty/Smarty.class.php';

class sfwTemplaterEngine_Smarty
{
  /**
   * the smarty delegate
   */
  protected $_smarty;
  
  public function __construct()
  {
    $this->_smarty = new Smarty();
    
    $this->_smarty->template_dir = ROOT_PATH . '/templates';
    $this->_smarty->compile_dir = SFW_PATH . '/compiled/smarty';
    $this->_smarty->cache_dir = SFW_PATH . '/cache/smarty';
    $this->_smarty->config_dir = SFW_PATH . '/configs/smarty';
    $this->_smarty->debugging = true;
  }
	
  public function assign($var, $val)
  {
    $this->_smarty->assign($var, $val);
  }
  
  public function display($tpl)
  {
    $this->_smarty->display($tpl);
  }
  
  public function debug($isdebug)
  {
  	$this->_smarty->debugging = $isdebug;
  }
}
?>
