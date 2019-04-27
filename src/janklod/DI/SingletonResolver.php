<?php 
namespace JK\DI;



/**
 * @package JK\DI\SingletonResolver 
*/ 
class SingletonResolver extends CustomResolver
{
       
         /**
           * singletons container
           * @var array
         */
         private static $singletons = [];
         

        
        /**
         * Constructor
         * @param mixed $key 
         * @param mixed $value 
         * @return void
        */
        public function __construct($key, $value)
        {
               $this->ensureKeyParsed($key);
               self::$singletons[$key] = $value;
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