<?php 
namespace JK\Container;


/**
 * @package JK\Container\CustomResolver
*/ 
abstract class CustomResolver implements ResolverInterface
{
	   
         
           /**
            * instances
            * @var array
           */
           protected static $instances  = [];




	        /**
	         * Determine if output is instance of closure
	         * @return type
	        */
	        protected function check($container)
	        {
	             if($container instanceof \Closure)
	             {
	                   return $container();
	             }

	             return $container;
	        }


		  /**
		   * Get item from container
		   * @param string $key 
		   * @return mixed
		  */
		   abstract public function resolve($key);
		   


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