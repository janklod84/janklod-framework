<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        
       
        private $url;


        /**
         * Get uri
         * @return type
         */
        protected function boot()
        {
             $this->url = $this->app->request->get('url');
        }


        /**
         * Register service
         * @return void
        */
	    public function register()
	    {
            $this->app->singleton('router', function () {
                 return new Router($this->url);
            });
	    }
}