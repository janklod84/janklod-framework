<?php 
namespace JK\Security\Facades;

use JK\DI\ServiceProvider;
use JK\Security\Authenticate\Auth;
use JK\Http\Request;


/**
 * @package JK\Security\Facades\AuthenticateProvider
*/ 
class AuthenticateProvider extends ServiceProvider
{


/**
 * Bootstrap service
 * 
 * @return void
*/
public function boot()
{
     // Check session for Authentication
     $session = Request::capture()->session();
     Auth::check($session);
}


        
/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('auth', function () {
         return '';
    });
}
}