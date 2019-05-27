<?php 
namespace JK\Http\Sessions;


use JK\Collections\Collection;

/**
 * @package JK\Http\Sessions\Session 
*/ 
class Session 
{
      

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
      }
}


/**
* Put item in session
* @param string $name 
* @param mixed $value 
* @return void
*/
public function put($name, $value)
{
    return $_SESSION[$name] = $value;
}


/**
* Determine if has item in $_SESSION
* @param string $key 
* @return bool
*/
public function has($key): bool
{
   return isset($_SESSION[$key]);
}


/**
* Get item from $_SESSION
* @param string $key 
* @return mixed
*/
public function get($key)
{
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
    $_SESSION = [];
    session_destroy();
}



/**
* Get all item from $_SESSION
* @return array
*/
public function all()
{
	 return $_SESSION ?? [];
}


}