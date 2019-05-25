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
         * Register service
         * @return void
        */
	    public function register()
	    {
            $this->url = 'http://project.loc//';
            $this->app->singleton('router', function () {
                 return new Router($this->url);
            });
	    }
}