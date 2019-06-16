<?php 
namespace JK\Collections\Contracts;


/**
 * Collection interface
 *
 * @package JK\Collections\Contracts\Collectionnable
*/ 
interface Collectionnable extends \IteratorAggregate, \ArrayAccess
{
       

/**
* Set item
* @param string $key 
* @param mixed $value 
* @return void
*/
public function set($key, $value);



/**
  * Get item
  * @param string $key 
  * @return mixed
*/
public function get($key);


/**
* Get count items
* @return int
*/
public function count();



/**
* Determine if item's setted
* @param string $key 
* @return bool
*/
public function has($key);


/**
* Remove item from container
* @param string $key 
* @return void
*/
public function remove($key);


/**
* Remove all items
* @return void
*/
public function clear();


/**
* Return all items
* @return array
*/
public function all();


}