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
         * @param mixed $route 
         * @return void
       */
  	    public static function store($route)
  	    {    
              if($route instanceof RouteCustomer)
              {
                   $method = $route->get('method');
                   self::$routes[$method][] = $route;
              }else{
                    self::$routes[] = $route;
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