<?php 
namespace JK\Container;


/**
 * @package JK\Container\ContainerInterface 
*/ 
interface ContainerInterface 
{
       
       /**
        * Set item in container
        * @param string $key 
        * @param mixed $value 
        * @return void
       */
	   public function set($key, $value);


	   /**
	    * Get item from container
	    * @param string $key 
	    * @return mixed
	   */
	   public function get($key);
}
