<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        
       
        private $uri;


        /**
         * Get uri
         * @return type
         */
        protected function boot()
        {
             $this->uri = $this->app->request->uri();
        }


        /**
         * Register service
         * @return void
        */
	    public function register()
	    {
            $this->app->singleton('router', function () {
                 return new Router($this->uri);
            });
	    }
}