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
		
	public static function bootstrap()
	{
		if(!isset($isBootstrapped) || $isBootstrapped == false)
		{
			$lang_paths = array(LANG_PATH, LANG_PATH_SF, LANG_PATH_CLASS);
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
