<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\RouteCollection
*/ 
class RouteCollection 
{

        /**
         * @var array
        */
	      private static $routes = [];
       

       /**
         * store route object
         * @param RouteObject $route 
         * @return void
       */
  	    public static function store(RouteObject $route)
  	    {    
             $method = $route->get('method');
             self::$routes[$method][] = $route;
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