<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        
      
        /**
         * Register service
         * @return void
        */
	    public function register()
	    {
            $url = trim($_SERVER['QUERY_STRING'], '/');
            $this->app->singleton('router', function () use($url) {
                 return new Router($url);
            });
	    }
}