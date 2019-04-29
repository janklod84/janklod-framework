<?php 
namespace JK\Helper;


/**
 * simple class Helper for working with array
 * this class 'll be extends to \ArrayAccess, \IteratorAggregate
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
        * Determine if item is set
        * @param string $key 
        * @return bool
       */
  	   public function has($key)
  	   {
  	   	   return isset($this->items[$key]);
  	   }
       
       
       /**
        * Determine if isset item and not empty
        * @param string $key 
        * @return bool
       */
       public function isEmpty($key): bool
       {
       	   return empty($this->items[$key]);
       }

       
       /**
        * Determine if key exist in container items
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
        * Sanitize all data
        * @return array
       */
       public function cleanAll()
       {
            $data = [];

            foreach($this->items as $index => $value)
            {
                $data[$index] = trim(Sanitize::input($value));
            }

            return $data;
       }

       
       /**
        * Sanitize on item
        * @param string $key 
        * @return mixed
       */
       public function cleanItem($key)
       {
            return $this->has($key) ? trim(Sanitize::input($this->items[$key])) : null;
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
  	   	   return $this->items ?: [];
  	   }
}