<?php 
namespace JK\Routing\RH;



/**
 * @package JK\Routing\RH\RouteCollection
*/ 
class RouteCollection 
{

/**
* @var array
*/
private static $routes = [];


/**
 * Add collection route
 * @param mixed $route
 * @param string $key 
 * @return void
*/
public static function store($key, $route)
{
 	self::$routes[$key] = $route;
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