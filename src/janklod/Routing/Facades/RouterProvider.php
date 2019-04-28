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
            $this->app->set('router', function () {
                 return new Router($this->app->request->uri());
            });
	    }
}