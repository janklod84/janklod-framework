<?php 
namespace JK\Http\Sessions;



/**
 * @package JK\Http\Sessions\Session 
*/ 
class Session 
{
      

/**
 * @var bool $status
 * @var string $filename
*/
private static $status = false;


/**
 * Set directory where will be saved sessions
 * 
 * @param string $directory
 * @return void
*/
private static function saveTo($directory)
{
     if(is_dir($directory))
     {
         ini_set('session.save_path', $directory);
         ini_set('session.gc_probability', 1);
     }
}



/**
 * Get current path where stored sessions
 * 
 * @return string
*/
private static function savedPath()
{
    return session_save_path();
}


/**
 * Ensure if session is started
 * 
 * @return void
*/
public static function start($directory='')
{
    self::saveTo($directory);
    if(session_status() === PHP_SESSION_NONE)
    {
	     session_start();
         self::$status = true;
    }
}


/**
* Put item in session
* 
* @param string $name 
* @param mixed $value 
* @return void
*/
public static function put($name, $value)
{
    self::ensureStarted();
    return $_SESSION[$name] = $value;
}


/**
* Determine if has item in $_SESSION
* 
* @param string $key 
* @return bool
*/
public static function has($key): bool
{
   self::ensureStarted();
   return isset($_SESSION[$key]);
}


/**
* Get item from $_SESSION
* 
* @param string $key 
* @return mixed
*/
public static function get($key)
{
    self::ensureStarted();
    if($this->has($key))
    {
        return $_SESSION[$key];
    }
    return null;
}


/**
 * Remove key in the session [delete]
 * 
 * @param string $key
 * @return void
*/
public static function remove($key)
{
    self::ensureStarted();
	if($this->has($key))
	{
	   unset($_SESSION[$key]);
	}
}


/**
 * Unset all data
 * 
 * @return void
*/
public static function clear()
{
    self::ensureStarted();
    $_SESSION = [];
    session_destroy();
}



/**
* Get all item from $_SESSION
* 
* @return array
*/
public static function all()
{
   self::ensureStarted();
   return $_SESSION ?? [];
}


/**
 * Make sure has started session
 * 
 * @return void
 */
private static function ensureStarted()
{
    if(!self::$status)
    {
        throw new \Exception('Sorry you must <b>No Session started!</b>');
    }
}

}