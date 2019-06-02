<?php 
namespace JK\Routing\Route;


use JK\Routing\Route\Controls\{
    OptionControl,
    PathControl,
    NameControl,
    CallbackControl, 
    MethodControl,
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
* Ex: Route::get('/contact', [
*  'controller' => 'HomeController',
*  'action'     => 'contact'
* ], contact.me);
* 
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteManager
*/
public static function get(
string $path, 
$callback, 
string $name = null
)
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
* @return RouteManager
*/
public static function post(
string $path, 
$callback, 
  string $name = null
)
{
    return self::add($path, $callback, $name, 'POST');
}


/**
* Add new package or resources of routes
* 
* @param string $path
* @param string $controller
* @return 
*/
public static function package(string $path, string $controller)
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
* Add routes group
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
       return RouteParameter::url($name, $params);
}


/**
* Add routes by request GET
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteManager
*/
public static function add(
$path, 
$callback, 
$name = null,  
$method = 'GET'
)
{
     # route custom
     $route = new RouteParameter([
        'path'               => PathControl::notPrepared($path), 
        'pattern'            => PathControl::pattern($path),
        'callback'           => CallbackControl::manage($callback),
        'name'               => NameControl::manage($callback, $name),
        'method'             => MethodControl::toUpper($method),  
        'prefix.path'        => OptionControl::retrieveItem('prefix', 'path'),
        'prefix.controller'  => OptionControl::retrieveItem('prefix', 'controller'),
        'middleware'         => OptionControl::retrieveGroup('middleware'),
        'module'             => OptionControl::retrieveGroup('module')
     ]);
    
     # store route by method
     RouteCollection::store($method, $route);
     return $route;
}



}