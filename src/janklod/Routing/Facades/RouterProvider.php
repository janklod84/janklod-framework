<?php 
namespace JK\Routing\Facades;

use JK\DI\ServiceProvider;
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
}


/**
 * Register service
 * 
 * @return void
*/
public function register()
{
  
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