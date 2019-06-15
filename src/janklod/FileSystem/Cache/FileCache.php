<?php 
namespace JK\FileSystem\Cache;


use JK\FileSystem\Contracts\CacheableInterface;


/**
 * @package JK\FileSystem\Cache\FileCache 
*/ 
class FileCache  implements  CacheableInterface
{


/**
 * Cache directory
 * 
 * @var string $cache_dir
*/
protected $cache_dir = '';



/**
 * Constructor
 * 
 * @param string $cache_dir 
 * @return void
*/
public function __construct($cache_dir='')	
{
     $this->cache_dir = $cache_dir;
}


/**
* Save data to the cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function set($key, $data)
{

}


/**
* Get data from cache by key
* 
* @param string $key 
* @return mixed
*/
public function get($key)
{

}


/**
* Delete data from cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function delete($key)
{

}



/**
* Determine if has cache or exist
* 
* @param string $key 
* @return bool
*/
public function exists($key)
{

}


}