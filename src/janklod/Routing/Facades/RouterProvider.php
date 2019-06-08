<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        

/**
 * Call routes
 * @return void
*/
public function boot()
{
   $this->app->file->call('routes/app.php');
}


/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('router', function () {
         return new Router($_GET['url']);
    });
}



/**
 * Do sommes actions after register
 * @return void
*/
public function after()
{
	$this->app->router->addRoutes(
	  \JK\Routing\Route\RouteCollection::all()
	);
}


}