<?php 
namespace JK\Authenticate;



/**
 * @package JK\Auth\Auth
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
         
}