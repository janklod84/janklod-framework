<?php 
namespace JK\Http;


use JK\Collections\Collection;

/**
 * @package JK\Http\Session 
*/ 
class Session 
{
      
/**
* @var JK\Collections\Collection $collection
*/
private $collection;


/**
* Constructor
* @return void
*/
public function __construct()
{
    $this->collection = new Collection($_SESSION);
}


/**
* Put item in session
* @param string $name 
* @param mixed $value 
* @return void
*/
public function put($name, $value)
{
    return $this->collection->set($name, $value);
}


/**
* Determine if has item in $_SESSION
* @param string $key 
* @return bool
*/
public function has($key): bool
{
   return $this->collection->has($key);
}


/**
* Get item from $_SESSION
* @param string $key 
* @return mixed
*/
public function get($key)
{
    return $this->collection->get($key);
}


/**
* Get all item from $_SESSION
* @return array
*/
public function all()
{
	 return $this->collection->all();
}
}