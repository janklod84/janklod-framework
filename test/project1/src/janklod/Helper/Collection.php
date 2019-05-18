<?php 
namespace JK\Helper;


/**
 * simple class Helper for working with array
 * this class 'll be later extends to \ArrayAccess, \IteratorAggregate
 * for good acces to object as array and so on..
 * @package JK\Helper\Collection 
*/ 
class Collection 
{
       
   /**
    * container collection
    * @var array $items
   */
   private $items = [];


   /**
    * Constructor
    * @param array $items 
    * @return void
   */
   public function __construct($items = [])
   {
          $this->items = $items;
   }

   
   /**
    * Set item
    * @param string $key 
    * @param mixed $value 
    * @return void
   */
   public function set($key, $value)
   {
   	   $this->items[$key] = $value;
   }


   /**
      * Get item
      * @param string $key 
      * @return mixed
   */
   public function get($key = null)
   {
   	    return $this->has($key) ? $this->items[$key] : null;
   }


   /**
    * Determine if item's setted
    * @param string $key 
    * @return bool
   */
   public function has($key)
   {
   	   return isset($this->items[$key]);
   }
   
   
   /**
    * Determine if is empty item
    * @param string $key 
    * @return bool
   */
   public function isEmpty($key): bool
   {
   	   return empty($this->items[$key]);
   }

   
   /**
    * Determine if exist key in container items
    * @param string $key 
    * @return bool
   */
   public function exist($key): bool
   {
   	   return array_key_exists($key, $this->items);
   }

   
   /**
    * Remove item from container
    * @param string $key 
    * @return void
   */
   public function remove($key)
   {
   	   if($this->has($key))
   	   {
   	   	   unset($this->items[$key]);
   	   }
   }

   
   /**
    * Remove all items
    * @return void
   */
   public function clear()
   {
       $this->items = [];
   }


   /**
    * Return all items
    * @return array
   */
   public function all()
   {
   	   return $this->items;
   }
}