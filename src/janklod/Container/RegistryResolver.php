<?php 
namespace JK\Container;


/**
 * This class manage all Registry
 * @package JK\Container\RegistryResolver 
*/ 
class RegistryResolver extends CustomResolver
{

       
        /**
          * registry container
          * @var array
        */
        protected static $registry = [];



        /**
         * Constructor
         * @param mixed $key 
         * @param mixed $value 
         * @return void
        */
        public function __construct($key, $value = null)
        {
        	   if(!is_null($key))
        	   {
        	   	   self::$registry[$key] = $value;
        	   }
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
         * @param mixed $key 
         * @return bool
        */
        protected function has($key): bool
        {
        	 return isset(self::$registry[$key]);
        }

}