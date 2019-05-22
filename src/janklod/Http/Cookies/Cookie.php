<?php 
namespace JK\Http;


use JK\Collections\Collection;

/**
 * @package JK\Http\Cookie 
*/ 
class Cookie 
{

/**
* @var JK\Collections\Collection $collection
*/
private $collection;


/**
* Constructor
* @param array $cookies 
* @return void
*/
public function __construct()
{
   $this->collection = new Collection($_COOKIE);
}


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
   return $this->collection  
              ->has($key);
}


/**
* Get item from $_COOKIE
* @param string $key 
* @return mixed
*/
public function get($key)
{
    if($this->collection->has($key))
    {
    	 return $this->collection 
    	             ->get($key);
    }
}


/**
* Delete cookies by $key
* @param $key
*/
public static function delete($key)
{
	if($this->collection->has($key)))
	{
		 $this->set($key, '', -3600);
		 return $this->collection->remove($key);
	}
}



/**
* Get all cookies from $_COOKIE
* @return array
*/
public function all()
{
	  return $this->collection
                ->all();
}
}