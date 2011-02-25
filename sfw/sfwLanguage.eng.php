<?php
/* $Id: sfwLanguage.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwLanguage.eng.php
 * Created on Jul 20, 2007
 * by johnny
 */

 
class sfwLanguage
{
	private static $isBootstrapped;
	private static $lang_includes;
	
	/**
	 * includes all the translation files
	 */
	public static function bootstrap()
	{
		if(!isset($isBootstrapped) || $isBootstrapped == false)
		{
			global $g_Language;
			// LANGUAGE SETTING - sets language folder //////////////////////////////////////
      $lang_path = APPLICATION_PATH . '/language/' . $g_Language;
      $lang_path_sfw = SFW_PATH . '/language/' . $g_Language;
      $lang_path_class = CLASS_PATH . '/language/' . $g_Language;
			
			$lang_paths = array($lang_path, $lang_path_sfw, $lang_path_class);
			$lang_includes = array();
			
			foreach($lang_paths as $lang_path)
			{
				$langfiles = array();
				if(file_exists($lang_path))
				{
					$langfiles = scandir($lang_path);
					foreach($langfiles as $langfile)
					{
						if($langfile[0] != '.' && !strstr($langfile, "CVS"))
						{
							$langfile = $lang_path . "/" . $langfile;
						} 
						else
						{
							continue;	
						}
						include_once($langfile);
						$lang_includes[] = $langfile;
					}
				}
			}
		}	
	}
}

sfwLanguage::bootstrap();
?>
