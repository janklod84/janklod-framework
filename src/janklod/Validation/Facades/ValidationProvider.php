<?php 
namespace JK\Validation\Facades;

use JK\Service\ServiceProvider;
use JK\Validation\Validator;

/**
 * @package JK\Validation\Facades\ValidationProvider
*/ 
class ValidationProvider extends ServiceProvider
{
        
/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('validate', function () {
         return new Validator();
    });
}
}