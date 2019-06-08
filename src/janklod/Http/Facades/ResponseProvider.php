<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Response;


/**
 * @package JanKlod\Http\Facades\ResponseProvider
*/
class ResponseProvider extends ServiceProvider
{

/**
 * Register 
 * @return type
 */
public function register()
{
   $this->app->singleton('response', function () {
       return $this->app->make(Response::class);
   });
}

}
