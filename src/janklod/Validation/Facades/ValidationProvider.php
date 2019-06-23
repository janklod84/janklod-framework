<?php 
namespace JK\Validation\Facades;

use JK\DI\ServiceProvider;
use JK\Validation\Validate;
use \Query;

/**
 * @package JK\Validation\Facades\ValidationProvider 
*/ 
class ValidationProvider  extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->singleton('validation', function () {
               return $this->app->make(Validate::class, [Query::connect()]);
           });
       }
}