<?php 
namespace JK\Routing\Registers;



/**
 * @package JK\Routing\Registers\RouteCollection
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
* Get all route
* @return array
*/
public static function all()
{
     return self::$routes;
}

}