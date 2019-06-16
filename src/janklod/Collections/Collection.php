<?php 
namespace JK\Collections;


use JK\Collections\Contracts\Collectionnable;


/**
 * simple class Helper for working with array
 * this class 'll be later extends to \ArrayAccess, \IteratorAggregate
 * for good acces to object as array and so on..
 * 
 * @package JK\Collections\Collection 
*/ 
class Collection implements Collectionnable
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
public function get($key)
{
    $index = explode('.', $key);
    return $this->getValue($index, $this->items);
}

/**
* Get value
* 
* @param array $indexes 
* @param mixed $value 
* @return null|Collection
*/
protected function getValue(array $indexes, $value)
{
    $key = array_shift($indexes); // unset first key

    if(empty($indexes))
    {
         return $this->getNotEmptyIndexes($key, $value);
    }else{
         return $this->getValue($indexes, $value[$key]);
    }
}


/**
 * Get not empty indexes
 * 
 * @param string $key 
 * @param void $value 
 * @return mixed
*/
protected function getNotEmptyIndexes($key, $value)
{
   if(!array_key_exists($key, $value))
   {
        return null;
   }
   if(is_array($value[$key]))
   {
       return new Collection($value[$key]);
   }else{
       return $value[$key];
   }
}


/**
 * Listing array
 * 
 * @param mixed $key
 * @param mixed $value
 * @return Collection
*/
public function lists($key, $value)
{
   $results = [];
   foreach($this->items as $item) 
   {
       $results[$item[$key]] = $item[$value];
   }

   return new Collection($results);
}


/**
 * Extract values of Array without key
 * 
 * @param string $key 
 * @return Collection
*/
public function extract($key)
{
    $results = [];
    foreach($this->items as $item)
    {
       $results[] = $item[$key];
    }
    return new Collection($results);
}

/**
 * Check data without imploded key
 * 
 * @param string $glue 
 * @return string
*/
public function join($glue)
{
    return implode($glue, $this->items);
}


/**
 * Get collection maximum
 * 
 * @param bool $key 
 * @return mixed
*/
public function max($key = false)
{
    if($key)
    {
        return $this->extract($key)->max();
    }
    return max($this->items);
}


/**
* Get collection keys
*
* @return array The collection's source data keys
*/
public function keys()
{
    return array_keys($this->items);
}



/**
 * Has key
 * 
 * @param string $key 
 * @return bool
*/
public function keyExist($key)
{
     return array_key_exists($key, $this->items);
}


/**
* Get count items
* @return int
*/
public function count()
{
    return count($this->items);
}


/**
 * Replace
 * @param array $items 
 * @return void
*/
public function replace($items)
{
   foreach($items as $key => $value)
   {
        $this->set($key, $value);
   }
}


/**
* Determine if item's setted
* 
* @param string $key 
* @return bool
*/
public function has($key): bool
{
	   return isset($this->items[$key]);
}


/**
* Remove item from container
* 
* @param string $key 
* @return void
*/
public function remove($key)
{
	   unset($this->items[$key]);
}


/**
* Remove all items
* 
* @return void
*/
public function clear()
{
   $this->items = [];
}


/**
* Return all items
* 
* @return array
*/
public function all()
{
   return $this->items;
}


/**
 * Implemetation method [interface \ArrayAccess]
 * 
 * 
 * @param type $offset 
 * @return bool
*/
public function offsetExists($offset)
{
    return $this->has($offset);
}

/**
 * Implemetation method [interface \ArrayAccess]
 * 
 * 
 * @param type $offset 
 * @return mixed
*/
public function offsetGet($offset)
{
   return $this->get($offset);
}


/**
 * Implemetation method [interface \ArrayAccess]
 * 
 * 
 * @param type $offset 
 * @param type $value
 * @return 
*/
public function offsetSet($offset, $value)
{
     return $this->set($offset, $value);
}

/**
 * Implemetation method [interface \ArrayAccess]
 * 
 * @param type $offset 
 * @param type $value
 * @return 
*/
public function offsetUnset($offset)
{
  if($this->has($offset))
  {
      unset($this->items[$offset]);
  }
}

/**
  * Implementation method [interface \IteratorAggregate]
  * 
  * @return \ArrayIterator [ return un objet de type \Traversable]
*/
public function getIterator()
{
    return new ArrayIterator($this->items);
}

}