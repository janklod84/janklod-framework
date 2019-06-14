<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        

private $url;


/**
 * Bootstrap
 * 
 * @return void
*/
public function boot()
{
   // require routes paths
   $this->app->file->call('routes/app.php');

   // set url
   $this->url = $this->app->request->get('url');
}


/**
 * Register service
 * 
 * @return void
*/
public function register()
{
    $this->app->singleton('router', function () {
         return $this->app->make(Router::class, [$this->url]);
    });
}



/**
 * Do sommes actions after register
 * 
 * @return void
*/
public function after()
{
	
}


}