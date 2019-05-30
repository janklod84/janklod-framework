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
            $this->app->singleton('router', function () {
                 return new Router($_GET['url']);
            });
	    }
}