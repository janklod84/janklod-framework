<?php 
namespace JK\DI;


/**
 * This class manage all Registry
 * @package JK\DI\RegistryResolver 
*/ 
class RegistryResolver extends CustomResolver
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
    	   $this->ensureKeyParsed($key);
    	   self::$registry[$key] = $value;
    }



    /**
     * Remove param from container
     * @param string $key 
     * @return mixed
    */
    public function resolve($key)
    {
          if($this->has($key))
          {
          	  return $this->check(self::$registry[$key]);
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