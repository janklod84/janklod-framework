<?php 
namespace JK\Container;


/**
 * This class manage all Registry
 * @package JK\Container\RegistryContainer 
*/ 
class RegistryContainer extends CustomContainer
{

       /**
         * @var array
        */
        private static $container = [];

        
        
        /**
         * Constructor
         * @param mixed $key 
         * @param mixed $value 
         * @return void
        */
        public function __construct($key = null, $value = null)
        {
        	   if(!is_null($key))
        	   {
        	   	   self::$container[$key] = $value;
        	   }
        }


        
        /**
         * Bind param in container
         * @param string $key 
         * @param mixed $value 
         * @return void
        */
        public function set($key, $value)
        {
              self::$container[$key] = $value;
        }

       

        /**
         * Remove param from container
         * @param string $key 
         * @return mixed
        */
        public function get($key)
        {
              if($this->has($key))
              {
              	  return $this->check(self::$container[$key]);
              }
        }


        /**
         * Determine if has item in container
         * @param mixed $key 
         * @return bool
        */
        protected function has($key): bool
        {
        	 return isset(self::$container[$key]);
        }

}