<?php 
namespace JK\Http\Cookies;


use JK\Collections\Collection;

/**
 * @package JK\Http\Cookies\Cookie 
*/ 
class Cookie 
{


/**
* Set cookie
* @param string $name 
* @param mixed $value 
* @param int $times 
* @param string $domain 
* @param bool $httpOnly 
* @return void
*/
public function set(
$name, 
$value, 
$times = 3600, 
$domain = '/', 
$httpOnly = false)
{
   setcookie($key, $value, time() + $times, $domain, $httpOnly);
}


/**
* Determine if has item in $_COOKIE
* @param string $key 
* @return bool
*/
public function has($key): bool
{
   return isset($_COOKIE[$key]);
}


/**
* Get item from $_COOKIE
* @param string $key 
* @return mixed
*/
public function get($key)
{
    if($this->has($key))
    {
        return $_COOKIE[$key];
    }
    return null;
}


/**
* Delete cookies by $key
* @param $key
*/
public static function delete($key)
{
	if($this->has($key))
	{
		 $this->set($key, '', -3600);
		 return unset($_COOKIE[$key]);
	}
}



/**
* Get all cookies from $_COOKIE
* @return array
*/
public function all()
{
	  return $_COOKIE ?? [];
}
}