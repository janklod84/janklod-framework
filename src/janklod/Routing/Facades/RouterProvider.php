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
   // add more fonctionnalites here [ http://localhost:8000/ ]
   // $url = $this->app->request->get('url') ?? '/?';
   $this->url = $this->app->request->get('url') ?? '';
}


/**
 * Register service
 * 
 * @return void
*/
public function register()
{
    $this->app->singleton('router', function () {
         return new Router($this->url);
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