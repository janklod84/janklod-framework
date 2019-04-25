<?php 
namespace JK\Container;


/**
 * @package JK\Container\CustomContainer
*/ 
abstract class CustomContainer implements ContainerInterface
{
	  

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
	        * Set item in container
	        * @param string $key 
	        * @param mixed $value 
	        * @return void
	       */
		   abstract public function set($key, $value);


		  /**
		   * Get item from container
		   * @param string $key 
		   * @return mixed
		  */
		   abstract public function get($key);
}