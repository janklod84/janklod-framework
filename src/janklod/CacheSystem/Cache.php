<?php 
namespace JK\CacheSystem;


use JK\CacheSystem\Contracts\CacheableInterface;


/**
 * Class Cache Adapter
 * 
 * @package JK\CacheSystem\Cache 
*/ 
class Cache 
{

/**
 * @var CacheableInterface
*/
protected $cacheable;


/**
 * Constructor
 * 
 * @param CacheableInterface $cacheable 
 * @return void
*/
public function __construct(CacheableInterface $cacheable)
{
    $this->cacheable = $cacheable;
}


/**
 * Save data to the cache
 * 
 * @param string $key 
 * @param mixed $data 
 * @return self
*/
public function set($key, $data)
{
   $this->cacheable->set($key, $data);
   return $this;
}

 
 /**
  * Get data from the cache
  * 
  * @param  string $key 
  * @return string
*/
public function get($key)
{
   return $this->cacheable->get($key);
}
 
 
/**
  * Delete the specified cache data
  * 
  * @param string $key
  * @return bool
*/
public function delete($key)
{
    return $this->cacheable->delete($key);
}  


}