<?php 
namespace JK\Config\Facades;

use JK\Service\ServiceProvider;
use JK\Config\Config;


/**
 * @package JK\Config\Facades\ConfigProvider
*/
class ConfigProvider extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->singleton('config', function () {
               return new Config();
           });
       }
}