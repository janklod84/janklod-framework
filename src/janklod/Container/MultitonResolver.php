<?php 
namespace JK\Container;


/**
 * This class manager all singletons
 * @package JK\Container\MultitonResolver
*/ 
class MultitonResolver extends CustomResolver
{
	   

          /**
            * singletons container
            * @var array
         */
         protected static $singletons = [];
         

        
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
                   self::$singletons[$key] = $value;
               }
        }



        /**
         * Get resolver
         * @param string $key 
         * @return mixed
        */
        public function resolve($key)
        {
             if(!$this->instanciated($key))
             {
                 self::$instances[$key] = $this->check(self::$singletons[$key]);
             }

             return self::$instances[$key];
        }
        
}