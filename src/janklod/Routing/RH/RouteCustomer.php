<?php 
namespace JK\Routing;


/**
 * Route Handler
 * @package JK\Routing\RouteCustomer
*/ 
class RouteCustomer
{
       
/**
 * @var array  $regex  [ Route regex ]
 * @var array  $namedRoutes [ Named Routes ]
 * @var \JK\Routing\RouteParameter $parameter
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



}