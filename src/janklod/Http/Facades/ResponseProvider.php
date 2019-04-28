<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Response;


/**
 * @package JanKlod\Http\Facades\ResponseProvider
*/
class ResponseProvider extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->set('response', function () {
               return new Response();
           });
       }
}
