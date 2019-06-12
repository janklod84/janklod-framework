<?php 
namespace JK\Routing\Facades;

use JK\Service\ServiceProvider;
use JK\Routing\Router;


/**
 * @package JK\Routing\Facades\RouterProvider 
*/ 
class RouterProvider extends ServiceProvider
{
        

private function dd($arr, $die=false)
{
	 echo '<pre>';
	 print_r($arr);
	 echo '</pre>';
	 if($die) die;
}

/**
 * Call routes
 * @return void
*/
public function boot()
{
   $this->app->file->call('routes/app.php');

   $router = new Router();
   $router->dispatch();
   $this->dd($router);
}


/**
 * Register service
 * 
 * @return void
*/
public function register()
{
	// add more fonctionnalites here [ http://localhost:8000/ ]
	// $url = $this->app->request->get('url') ?? '/?';
	// $url = $this->app->request->get('url') ?? '';
 //    $this->app->singleton('router', function () use($url) {
 //         return new Router($url);
 //    });
}



/**
 * Do sommes actions after register
 * @return void
*/
public function after()
{
	// $this->app->router->addRoutes(
	//   \JK\Routing\Route\RouteCollection::all()
	// );
}


}