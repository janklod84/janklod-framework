<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Route 
*/ 
class Route 
{
      

/**
 * @var string   $module
 * @var array    $prefixes
 * @var array    $middleware
*/
protected static $module      = '';
protected static $prefixes    = [];
protected static $middlewares = [];




/**
* Add routes by method GET
* 
* 
* @param  string $path 
* @param  \Closure|string $callback 
* @param  string $name 
* @return RouteParam
*/
public static function get(string $path, $callback, string $name = null)
{
    return self::add($path, $callback, $name, 'GET');
}


/**
* Add routes by method POST
* 
* @param  string $path 
* @param  \Closure|string $callback 
* @param  string $name 
* @return RouteParam
*/
public static function post(string $path, $callback, string $name = null)
{
    return self::add($path, $callback, $name, 'POST');
}


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
*
* 
* @param array $options
* @param \Closure $callback
* @return void
*/
public static function group($options = [], \Closure $callback)
{  
    
}



/**
* Add prefixed routes and controller
* 
* @param array $prefixes
* @param \Closure $callback
* @return void
*/
public static function prefix($prefixes = [], \Closure $callback)
{  
     self::$prefixes = $prefixes;
     call_user_func($callback);
     self::$prefixes = [];
}


/**
* Add route module
* 
* 
* @param string $module [ Module name ]
* @param \Closure $callback
* @return void
*/
public static function module(string $module, \Closure $callback)
{  
     self::$module = $module;
     call_user_func($callback);
     self::$module = '';
}


/**
* Add route middlewares
* 
* @param array $middlewares
* @param \Closure $callback
* @return void
*/
public static function middleware($middlewares=[], \Closure $callback)
{  
     self::$middlewares = $middlewares;
     call_user_func($callback);
     self::$middlewares = [];
}



/**
 * Get URL Named route
 * 
 * @param string $name 
 * @param array $params 
 * @return string
*/
public static function url(string $name, array $params = [])
{
       return RouteParam::url($name, $params);
}



/**
* Add routes
*
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @param string $method
* @return RouteParam
*/
public static function add($path, $callback, $name = null,  $method = 'GET')
{
     # route param
     $path     = self::path($path);
     $callback = self::callback($callback);

     $route = new RouteParam($path, $callback, $name, $method);
     $route->addMiddlewares(self::$middlewares);
     $route->addModule(self::$module);


     # before storage
     $route->beforeStorage();

     # storage routes
     RouteCollection::store($method, $route);

     # return current route
     return $route;
}


/**
 * Get prefix
 * 
 * @param string $key 
 * @return string
*/
public static function prefixed($key)
{
     return self::$prefixes[$key] ?? '';
}


/**
 * Get path
 * 
 * @param string $path 
 * @return string 
*/
public static function path($path)
{
    $path = trim($path, '/');
    if($prefix = self::prefixed('path'))
    {
         $path = trim($prefix, '/') . '/'. $path;
    }
    return trim($path, '/');
}


/**
 * Get callabck
 * 
 * @param string $callback 
 * @return string
*/
public static function callback($callback)
{
     if(is_string($callback))
     {
        if($prefix = self::prefixed('controller'))
        {
             $callback = $prefix.'\\'. $callback; 
        }
     }
     return $callback;
}

}