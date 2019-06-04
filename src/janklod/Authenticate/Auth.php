<?php 
namespace JK\Authenticate;



/**
 * @package JK\Auth\Auth
*/ 
class Auth
{
          
          
/**
* @var   bool $authorized
* @var \JK\Http\Sessions\Session $session
*/
private static $authorized = false;
private static $session;


/**
 * Check session
 * @param \JK\Http\Sessions\Session $session
 * @return void
*/
public static function check($session)
{
    self::$session = $session;
}

/**
* Determine if current user is logged
* This key it basic, after we will hashing key for obtain good session key
* like it sess.user_---.sha1($_SERVER['HTTP_HOST']) . .... etc
* more advanced to do ..
* crypting session.key ..
* 
* @return bool [ Session::has('sess.user') ]
*/
public static function isLogged()
{
	 return self::$session->has('session.user');
}



/**
* Authorize current user
* @return void
*/
public static function authorized()
{
    // TO implements
}



/**
* Unauthorize current user
* @return void
*/
public static function unauthorized()
{
   // To implements
}
         
}