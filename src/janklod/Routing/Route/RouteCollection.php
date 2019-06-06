<?php 
namespace JK\Routing\Route;



/**
 * @package JK\Routing\Route\RouteCollection
*/ 
class RouteCollection 
{

/**
* @var array
*/
private static $routes = [];


/**
 * Add collection route
 * @param string $key
 * @param mixed $route 
 * @return void
*/
public static function store($key, $route)
{
 	self::$routes[$key][] = $route;
}


/**
 * Get route by group
 * 
 * @param string $name 
 * @return array
*/
public static function group($name)
{
    if(!self::isStored($name))
    {
    	 throw new \Exception("This group [$name] does not is set!", 404); 
    }
    return self::$routes[$name];
}


/**
 * Determine if has group in collection
 * 
 * @param string $name 
 * @return bool
*/
public static function isStored($name): bool
{
    return isset(self::$routes[$name]);
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