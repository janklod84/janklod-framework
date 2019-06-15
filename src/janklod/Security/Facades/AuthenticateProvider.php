<?php 
namespace JK\Security\Facades;

use JK\DI\ServiceProvider;
use JK\Security\Authenticate\Auth;



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
     $session = $this->app->request->session();
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