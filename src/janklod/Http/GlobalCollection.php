<?php 
namespace JK\Http;


use \JK\Helper\Collection;


/**
 * @package JK\Http\GlobalCollection
*/ 
class GlobalCollection
{
       
     /**
      * @var \JK\Helper\Collection $collection
     */
     private $collection;

    
    /**
      * Constructor
      * @param array $data
      * @return void
     */
     public function __construct($data = [])
     {
         $this->collection = new Collection($data);
     }

       
     /**
      * Get item from superglobal
      * @param string $key 
      * @return mixed
     */
	   public function get($key = null)
	   {
	   	   if(is_null($key))
	   	   {
	   	   	  return $this->collection->all();
	   	   }
         return $this->collection->get($key);
	   }

     
}