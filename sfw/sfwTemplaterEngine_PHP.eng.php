<?php
//$Id$
/**
 * @file
 *
 * @author
 */

class sfwTemplaterEngine_PHP
{
	protected $_tpl_vars;
	
	public function __construct()
	{
		$this->_tpl_vars = array();

	}
	
  /**
   * assigns values to template variables
   *
   * @param array|string $tpl_var the template variable name(s)
   * @param mixed $value the value to assign
   */
  function assign($tpl_var, $value = null)
  {
    if (is_array($tpl_var)){
      foreach ($tpl_var as $key => $val) {
        if ($key != '') {
          $this->_tpl_vars[$key] = $val;
        }
      }
    } else {
      if ($tpl_var != '')
        $this->_tpl_vars[$tpl_var] = $value;
    }
  }
  
  public function display($tpl)
  {
    
  	
  }
}
?>
