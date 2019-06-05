<?php 
namespace JK\Security\Encryption;


/**
 * @package JK\Security\Encryption\CsrfToken
*/
class CsrfToken 
{

            
/**
 * @var string
*/
private static $tokenName;


/**
 * Token key
 * @const string
*/
const TOKEN_KEY = '_csrf';



/**
 * Constructor
 * @param array $config 
 * @return void
*/
public function __construct() 
{

}



/**
 * Generate token
 * @return string
*/
public static function generate()
{
	  // return Session::put(self::TOKEN_KEY, md5(uniqid()));
}


/**
 * Check if token valid
 * Simple test, later it'll more advanced
 * 
 * @param string $token 
 * @return bool
*/
public static function check($token)
{
     /*
      $tokenName = self::TOKEN_KEY;

	  if(Session::has($tokenName) && $token === Session::check($tokenName))
	  {
              Session::remove($tokenName);
	  	      return true;
	  }

      return false;
    */
}

}