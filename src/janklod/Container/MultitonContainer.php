<?php 
namespace JK\Container;


/**
 * This class manager all singletons
 * @package JK\Container\MultitonContainer 
*/ 
class MultitonContainer extends CustomContainer
{
	   

	    /**
         * Singletons container
         * @var array
        */
        private static $singletons = [];

        
        /**
         * Singleton instances
         * @var array
         */
        private static $instances  = [];

        
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
                   self::$singletons[$key] = $value;
               }
        }

        
        /**
         * Bind param in container
         * @param mixed $key 
         * @param mixed $value 
         * @return void
        */
        public function set($key, $value)
        {
              self::$singletons[$key] = $value;
        }


        /**
         * Remove param from container
         * @param string $key 
         * @return mixed
        */
        public function get($key)
        {
             if(!$this->instanciated($key))
             {
                 self::$instances[$key] = $this->check(self::$singletons[$key]);
             }

             return self::$instances[$key];
        }
        

        /**
         * Determine if item has instanciated
         * @param mixed $key 
         * @return bool
        */
        public function instanciated($key): bool
        {
            return isset(self::$instances[$key]);
        }
}