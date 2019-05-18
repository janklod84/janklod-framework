<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Request;



/**
 * @package RequestProvider
*/
class RequestProvider extends ServiceProvider
{
       
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
