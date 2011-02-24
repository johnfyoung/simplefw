<?php
/* $Id: sfwEncryption.eng.php 22 2009-04-27 21:44:56Z codecrea $
 * sfwEncryption.php
 * Created on May 29, 2007
 * by johnny
 */

require_once LIB_PATH.'/StonePhpSafeCrypt/StonePhpSafeCrypt.php';

class sfwEncryptionException extends Exception {}

/**
 * sfwEncryption Class - static class handles encryption requests
 */
class sfwEncryption
{
	public function encrypt($plaintext)
	{
		$packed = PackCrypt($plaintext, 'Password');
		if(isset($packed['state']) &&  $packed['state'] === false)
		{
			throw new sfwEncryptionException("sfwEncryption:: encrypt() - problem: ". $packed['reason']);
		}
		
		return $packed['output'];
	}

	public function decrypt($crypttext)
	{	
		$plaintext = UnpackCrypt($crypttext, 'Password');
		if(isset($plaintext['state']) && $plaintext['state']=== false)
		{
			throw new sfwEncryptionException("sfwEncryption:: decrypt() - problem: ". $plaintext['reason']);
		}
		
		return $plaintext['output'];
	}
}
?>