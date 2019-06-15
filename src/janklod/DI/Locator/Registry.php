<?php 
namespace JK\DI\Locator;


use JK\DI\Contracts\RegistrableInterface;

/**
 * @package JK\DI\Locator\Registry
*/ 
class Registry implements RegistrableInterface
{


/**
* registry container
* @var array
*/
private static $registry = [];



/**
* Constructor
* @param string $key 
* @param mixed $value 
* @return void
*/
public function __construct($key, $value)
{
  self::set($key, $value);
}


/**
* Set item
* @param string $key 
* @param mixed $value 
* @return void
*/
public function set($key, $value)
{
  self::$registry[$key] = $value;
}



/**
* get item from container
* @param string $key 
* @return mixed
*/
public function get($key)
{
  if($this->has($key))
  {
  	  return self::$registry[$key];
  }
}


/**
* Determine if has item in container
* @param string $key 
* @return bool
*/
protected function has($key): bool
{
    return isset(self::$registry[$key]);
}

}