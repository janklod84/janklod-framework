<?php 
namespace JK\Config\Facades;

use JK\Service\ServiceProvider;
use JK\Config\Config;


/**
 * @package JK\Config\Facades\ConfigProvider
*/
class ConfigProvider extends ServiceProvider
{


/**
* Do action before registring
* @return void
*/   
public function boot() {}


/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('config', function () {
         return '';
    });
}

}