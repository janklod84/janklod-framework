<?php 
namespace JK\FileSystem;


use JK\CacheSystem\Contracts\CacheableInterface ;
use JK\FileSystem\Exceptions\FileCacheException;


/**
 * @package JK\FileSystem\FileCache 
*/ 
class FileCache  implements  CacheableInterface
{


/**
 * @var  string  $cache_dir   [ Cache directory ]
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
     if(!is_dir($cache_dir))
     {
     	  mkdir($cache_dir, 0777, true);
     	  $this->cache_dir = $cache_dir;
     }
}


/**
 * Get cache file
 * 
 * @param type $key 
 * @return string
*/
public function cacheFile($key)
{
	return $this->cache_dir . DIRECTORY_SEPARATOR . md5($key) . '.txt';
}


/**
* Save data to the cache
* 
* @param  string $key 
* @param  mixed  $data 
* @param  int    $duration
* @return self
*/
public function set($key, $data, $duration = 3600)
{
	$content['data'] = $data;
	$content['end_time'] = time() + $duration;
	if(file_put_contents($this->cacheFile($key), serialize($content)))
	{
		 return true;
	}
    return false;
}


/**
* Get data from cache by key
* 
* @param string $key 
* @return mixed
*/
public function get($key)
{
   $cacheFile = $this->cacheFile($key);
   if(file_exists($cacheFile))
   {
        $content = unserialize(file_get_contents($cacheFile));
        if(time() <= $content['end_time'])
        {
        	 return $content['data'];
        }
        unlink($cacheFile);
   }
   return false;
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
    $cacheFile = $this->cacheFile($key);
    if($this->exists($key))
    {
    	unlink($cacheFile);
    }

}



/**
* Determine if has cache or exist
* 
* @param string $key 
* @return bool
*/
public function exists($key)
{
   return file_exists($this->cacheFile($key));
}


}