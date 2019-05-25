<?php 
namespace JK\Routing\RH;


/**
 * Route Handler
 * @package JK\Routing\RH\RouteCustomer
*/ 
class RouteCustomer
{
       
/**
 * @var array  $regex  [ Route regex ]
 * @var array  $namedRoutes [ Named Routes ]
 * @var \JK\Routing\RH\RouteParameter $parameter
*/ 
private $regex = [];
private static $namedRoutes = [];
private static $parameter;



/**
 * Constructor
 * @param \JK\Routing\RouteParameter $parameter
 * @return void
*/
public function __construct($params)
{
     self::$parameter = new RouteParameter($params);  
}


/**
 * Get parameter
 * @param string $key 
 * @return mixed
*/
public function get($key)
{
	return self::$parameter
	       ->get($key);
}


/**
 * Get route parameters
 * @return array
*/
public function parameters()
{
	return self::$parameter
	       ->parameters();
}



}