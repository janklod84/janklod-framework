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
         * Store curren route
         * @param \JK\Routing\RouteHandler $route 
         * @return void
       */
  	    public static function store(RouteHandler $route)
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