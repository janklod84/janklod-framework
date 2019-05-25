<?php 
namespace JK\Routing;


/**
 * Route Handler
 * @package JK\Routing\RH
*/ 
class RH
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
     self::$params = new RouteParameter($params);  
}



}