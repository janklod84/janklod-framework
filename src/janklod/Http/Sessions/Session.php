<?php 
namespace JK\Http\Sessions;



/**
 * @package JK\Http\Sessions\Session 
*/ 
class Session 
{
      

/**
 * @var bool $status
*/
private static $status = false;



/**
 * Ensure if session is started
 * 
 * @return void
*/
public static function start()
{
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
public function put($name, $value)
{
    $this->ensureStarted();
    return $_SESSION[$name] = $value;
}


/**
* Determine if has item in $_SESSION
* 
* @param string $key 
* @return bool
*/
public function has($key): bool
{
   $this->ensureStarted();
   return isset($_SESSION[$key]);
}


/**
* Get item from $_SESSION
* @param string $key 
* @return mixed
*/
public function get($key)
{
    $this->ensureStarted();
    if($this->has($key))
    {
        return $_SESSION[$key];
    }
    return null;
}


/**
 * Remove key in the session [delete]
 * @param string $key
 * @return void
*/
public function remove($key)
{
  $this->ensureStarted();
	if($this->has($key))
	{
	   unset($_SESSION[$key]);
	}
}


/**
 * Unset all data
 * @return void
*/
public function clear()
{
    $this->ensureStarted();
    $_SESSION = [];
    session_destroy();
}



/**
* Get all item from $_SESSION
* @return array
*/
public function all()
{
   $this->ensureStarted();
	 return $_SESSION ?? [];
}


/**
 * Make sure has started session
 * @return void
 */
private function ensureStarted()
{
    if(!self::$status)
    {
       exit('Sorry you must to start session !');
    }
}

}