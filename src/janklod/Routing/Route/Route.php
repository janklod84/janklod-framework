<?php 
namespace JK\Routing\Route;


use JK\Routing\Route\Controls\{
    OptionControl,
    PathControl,
    CallbackControl, 
    ModuleControl,
    MiddlewareControl
};


/**
 * @package JK\Routing\Route\Route 
*/ 
class Route 
{
      


/**
* Add routes by method GET
* 
* Ex: Route::get('/', 'HomeController@index', 'welcome.page');
* Ex: Route::get('/about', function() {
*      echo 'HI Friends!';
* });
* 
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteParam
*/
public static function get(string $path, $callback, string $name = null)
{
    return self::add($path, $callback, $name, 'GET');
}


/**
* Add routes by method POST
* 
* Ex: Route::post('/contact', 'HomeController@send');
* 
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteParam
*/
public static function post(string $path, $callback, string $name = null)
{
    return self::add($path, $callback, $name, 'POST');
}


// TO IMPLEMENTS METHODS PUT, PATCH, DELETE, OPTIONS .. 

/**
* Add new package or resources of routes
* 
* @param string $path
* @param string $controller
* @return void
*/
public static function resource(string $path, string $controller)
{
     self::get("$path", "$controller@index");
     self::post("$path/add", "$controller@add");
     self::post("$path/submit", "$controller@submit");
     self::post("$path/edit/:id", "$controller@edit");
     self::post("$path/save/:id", "$controller@save");
     self::post("$path/delete/:id", "$controller@delete");
}



/**
* Add routes group
* $options = [
*   'prefix' => [
*      'path' => 'admin',
*      'controller' => 'Backend'
*   ], 
*   'middleware' => [
*    .....
*   ],
*   'module' => '...'
* ];
* 
* Route::group($options, function () {
* 
*  Route::get('/login', 'LoginController@index');
*  ....
*  ....
* 
* });
* 
* @param array $options
* @param \Closure $callback
* @return void
*/
public static function group($options = [], \Closure $callback)
{  
    OptionControl::addOptions($options);
    call_user_func($callback); 
    OptionControl::cleanOptions();
}


/**
* Add prefixed routes and controller
* 
* $prefixes = [
*  'path' => 'admin',
*  'controller' => 'Backend'
* ];
* 
* Route::prefix($prefixes, function () {
* 
*  Route::get('/login', 'LoginController@index');
*  ....
*  ....
* 
* });
* 
* @param array $prefixes
* @param \Closure $callback
* @return void
*/
public static function prefix($prefixes = [], \Closure $callback)
{  
    OptionControl::addOption('prefix', $prefixes);
    return self::group($prefixes, $callback);
}


/**
* Add route modules
* 
* Route::module('eshop', function () {
*   Route::get('/', '....')
*   Route::get('/articles', '....')
*   Route::post('/contact', '....')
*   .....
* 
* });
* 
* @param string $module [Module name]
* @param \Closure $callback
* @return void
*/
public static function module($module, \Closure $callback)
{  
    OptionControl::addOption('module', $module);
    return self::group($module, $callback);
}


/**
* Add route middlewares
* 
* @param array $middleware
* @param \Closure $callback
* @return void
*/
public static function middleware($middleware, \Closure $callback)
{  
    OptionControl::addOption('middleware', $middleware);
    return self::group($middleware, $callback);
}



/**
 * Get URL Named route
 * @param string $name 
 * @param array $params 
 * @return string
*/
public static function url(string $name, array $params = [])
{
       return RouteParam::url($name, $params);
}


/**
* Add routes by request
*
* @param string $path 
* @param mixed $callback 
* @param string $name 
*
* @return RouteParam
*/
public static function add($path, $callback, $name = null,  $method = 'GET')
{
     # add all route params
     $route = new RouteParam([
        'path'               => PathControl::target($path), 
        'pattern'            => PathControl::pattern($path),
        'callback'           => CallbackControl::prepare($callback),
        'name'               => $name,
        'method'             => strtoupper($method),  
        'middleware'         => OptionControl::retrieveGroup('middleware'),
        'module'             => OptionControl::retrieveGroup('module')
     ]);

     # before storage
     if(is_string($callback) && $name === null)
     {
          $route->setParam('name', $callback);
     }

     if($name)
     {
         $route->namedRoutes($name);
     }
    
     # store route collection by method
     RouteCollection::store($method, $route);
     return $route;
}


}