<?php 
namespace JK\FileSystem\Contracts;

/**
 * @package JK\FileSystem\Contracts\CacheableInterface 
*/ 
interface CacheableInterface 
{


/**
* Save data to the cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function set($key, $data);



/**
* Get the specified data from the cache
* 
* @param string $key 
* @return mixed
*/
public function get($key);


/**
* Delete the specified data from the cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function delete($key);



/**
* Check if the specified cache key exists
* 
* @param string $key
* @return bool
*/
public function exists($key);


}