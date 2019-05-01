<?php 
namespace JK\DI;


/**
 * @package JK\DI\CustomResolver
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
    * @param mixed $parsed 
    * @return mixed
   */
   protected function check($parsed)
   {
       if($parsed instanceof \Closure)
       {
             return call_user_func($parsed);
       }

       return $parsed;
   }

  
  /**
   * Determine if has key
   * @param string $key 
   * @return void
  */
  protected function ensureKeyParsed($key)
  {
  	   if(is_null($key))
	     {
	   	       exit('Set please key for : <strong> ' . get_class($this) . '</strong>');
	     }
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