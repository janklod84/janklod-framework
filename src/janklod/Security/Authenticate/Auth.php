<?php 
namespace JK\Security\Authenticate;



/**
 * @package JK\Security\Authenticate\Auth
*/ 
class Auth
{
          
          
/**
* @var \JK\Http\Sessions\Session $session
* @var string $key [ Auth key user ]
*/
private static $session;
private static $key = 'sess.user_id'; // default


/**
 * Check session
 * 
 * @param \JK\Http\Sessions\Session $session
 * @return void
*/
public static function check($session)
{
    self::$session = $session;
}


/**
 * Add auth key
 * 
 * @param string $key
 * @return void
*/
public static function addKey($key)
{
    self::$key = $key;
}


/**
 * Get current auth key
 * 
 * @return string
*/
public static function getKey()
{
	 return self::$key;
}


/**
* Determine if current user is logged
* 
* @return bool
*/
public static function isLogged()
{
	 return self::$session->has(self::$key);
}


/**
 * Get current authenticate
 * @param null $item 
 * @return mixed
*/
public static function get($item=null)
{
     if(self::isLogged())
     {
     	  $current = self::$session->get(self::$key);
     	  if(isset($current[$item]))
     	  {
     	  	  return $current[$item];
     	  }
     	  return $current;
     }
}
         
}