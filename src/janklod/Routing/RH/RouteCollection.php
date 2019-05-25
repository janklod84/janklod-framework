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
 * Add route in collection
 * @param  $key 
 * @param  mixed $route 
 * @return void
*/
public static function add($key, $value)
{
	 self::$routes[$key] = $route;
}


/**
 * Description
 * @param mixed $route
 * @param string $key 
 * @return void
*/
public static function store($route, $key='')
{
     if($key !== '')
     {
       self::$routes[$key][] = $route;
     }else{
     	array_push(self::$routes, $route);
     }
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