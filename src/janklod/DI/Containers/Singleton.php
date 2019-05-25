<?php 
namespace JK\DI\Containers;



/**
 * @package JK\DI\Containers\Singleton 
*/ 
class Singleton implements RegisterInterface 
{
       
 /**
   * @var array $instances [ singletons container ]
   * @var array $singletons
 */
 protected static $instances  = [];
 protected static $singletons = [];
 


/**
 * Constructor
 * @param mixed $key 
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
    self::$singletons[$key] = $value;
}


/**
 * Get resolver
 * @param string $key 
 * @return mixed
*/
public function get($key)
{
     if(!$this->instanciated($key))
     {
         self::$instances[$key] = self::$singletons[$key];
     }

     return self::$instances[$key];
}


/**
 * Determine if has item in container
 * @param string $key 
 * @return bool
*/
protected function has($key): bool
{
     return isset(self::$singletons[$key]);
}



/**
   * Determine if item has instanciated
   * @param string $key 
   * @return bool
*/
protected function instanciated($key): bool
{
     return isset(self::$instances[$key]);
}

}