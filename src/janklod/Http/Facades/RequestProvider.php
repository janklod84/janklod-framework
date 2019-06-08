<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Request;
use JK\Http\Sessions\Session;


/**
 * @package RequestProvider
*/
class RequestProvider extends ServiceProvider
{
       
/**
* Do action before register
* @return void
*/
public function boot()
{
    Session::start();
}


/**
* Registering request provider
* @return type
*/
public function register()
{
   $this->app->singleton('request', function () {
       return new Request();
   });
}
}
