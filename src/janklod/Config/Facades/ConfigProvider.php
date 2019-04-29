<?php 
namespace JK\Config\Facades;

use JK\Service\ServiceProvider;
use JK\Config\Config;



/**
 * @package JK\Config\Facades\RouterProvider 
*/ 
class ConfigProvider extends ServiceProvider
{
        
        /**
         * Register service
         * @return void
        */
	    public function register()
	    {
            $this->app->singleton('config', function () {
                 return new Config();
            });
	    }
}