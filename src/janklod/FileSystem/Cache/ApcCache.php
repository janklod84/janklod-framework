<?php 
namespace JK\FileSystem\Cache;


/**
 * @package JK\FileSystem\Cache\ApcCache 
*/ 
class ApcCache 
{


/**
* Save data to the cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function set($key, $data)
{
     if(! apc_store(strtolower($key), $data))
	 {
	 	 throw new ApcCacheException(
	 	 sprintf(
	 	   'Error saving data withe the key [ %s ] to the APC cache.', 
	 	   $key
	 	 )); 
	 }
     return $this;
}


/**
* Get the specified data from the cache
* 
* @param string $key 
* @return mixed
*/
public function get($key)
{
    if($this->exists($key)) 
    {
	    if(!$data = apc_fetch(strtolower($key))) 
	    {
	        throw new ApcCacheException(
	         sprintf(
	         'Error fetching data with the key [ %s ] from the APC cache.',   
	           $key
	          ));
	    }
	    return $data;
	}
	return null;
}


/**
* Delete the specified data from the cache
* 
* @param string $key 
* @param mixed $data 
* @return void
*/
public function delete($key)
{
    if($this->exists($key)) 
    {
	    if(!apc_delete(strtolower($key))) 
	    {
	        throw new ApcCacheException(
	         sprintf(
	         'Error deleting data with the key [ %s ] from the APC cache.', 
	          $key
	         ));
	    }
	    return true;
	}
	return false;
}



/**
* Check if the specified cache key exists
* 
* @param string $key
* @return bool
*/
public function exists($key)
{
	return (boolean) apc_exists(strtolower($key));
}


/**
 * Get cache information
 * 
 * @return string
*/
public function getInfo()
{
	ob_start();
	echo '<pre>';
	print_r(apc_cache_info());
	echo '</pre>';
	return ob_get_clean();
}

/**
* Clear the cache
* 
* @param string $cacheType
* @return bool
*/
public function clear($cacheType = 'user')
{
    return apc_clear_cache($cacheType);
}

}