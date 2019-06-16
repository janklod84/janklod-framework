<?php 
namespace JK\CacheSystem\Facades;

use JK\DI\ServiceProvider;
use JK\CacheSystem\Cache;
use JK\FileSystem\FileCache;


/**
 * @package JK\CacheSystem\Facades\CacheProvider
*/ 
class CacheProvider extends ServiceProvider
{


/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('cache', function () {
          return $this->app->make(Cache::class, [
              $this->app->make(FileCache::class)
          ]);
    });
}

}