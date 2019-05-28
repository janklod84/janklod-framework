<?php 
namespace JK\Loader\Facades;

use JK\Service\ServiceProvider;
use JK\Loader\Load;

/**
 * @package JK\Loader\Facades\LoaderProvider 
*/ 
class LoaderProvider extends ServiceProvider
{
        
/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('load', function () {
         return new Load($this->app);
    });
}
}