<?php 
namespace JK\CacheSystem\Facades;

use JK\DI\ServiceProvider;
use JK\CacheSystem\Cache;
use JK\FileSystem\FileCache;
use JK\Foundation\Source;


/**
 * @package JK\CacheSystem\Facades\CacheProvider
*/ 
class CacheProvider extends ServiceProvider
{


/**
 * @var string
*/
private $cache_dir;


/**
 * Bootstrap
 * 
 * @return void
 */
public function boot()
{
   $this->cache_dir = \Config::get('cache.cache_dir') 
                      ?: Source::CONFIG['cache.dir'];
}


/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('cache', function () {
         return $this->app->file->cache($this->cache_dir);
    });
}

}