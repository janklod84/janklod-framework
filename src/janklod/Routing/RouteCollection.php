<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\RouteCollection
*/ 
class RouteCollection 
{



/**
 * @var array $routes
*/
private static $routes = [];



/**
 * Add collection route
 * 
 * @param  string      $method
 * @param  RouteParam  $route 
 * @return void
*/
public static function store($method, $route)
{
 	self::$routes[$method][] = $route;
}



/**
 * Add routes in collection
 * 
 * @param array $routes 
 * @return void
*/
public static function add($routes=[])
{
     self::$routes = array_merge(self::$routes, $routes);
}


/**
 * Get route by group
 * 
 * @param string $method 
 * @return array
*/
public static function group($method)
{
    if(!self::isStored($method))
    {
    	 throw new \Exception("This group [$method] does not is set!", 404); 
    }
    return self::$routes[$method];
}


/**
 * Determine if has group in collection
 * 
 * @param string $method 
 * @return bool
*/
public static function isStored($method): bool
{
    return isset(self::$routes[$method]);
}


/**
* Get all route
* 
* @return array
*/
public static function all()
{
     return self::$routes;
}

}