<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Route 
*/ 
class Route 
{
        

	    /**
	     * Add routes by method GET
	     * @param string $path 
	     * @param mixed $callback 
	     * @param string $name 
	     * @return RouteObject
	    */
	    public static function get(
	     	string $path, 
	     	$callback, 
	        string $name = null
	    )
	    {
            return self::add($path, $callback, $name, 'GET');
	    }


	    /**
	     * Add routes by method POST
	     * @param string $path 
	     * @param mixed $callback 
	     * @param string $name 
	     * @return RouteObject
	    */
	    public static function post(
	     	string $path, 
	     	$callback, 
	        string $name = null
	    )
	    {
            return self::add($path, $callback, $name, 'POST');
	    }


	    /**
        * Add new package or resources of routes
        * It's used for CRUD for example
        * 
        * @param string $path
        * @param string $controller
        * @return self
      */
       public static function package(string $path, string $controller)
       {
             self::get("$path", "$controller@index");
             self::post("$path/add", "$controller@add");
             self::post("$path/submit", "$controller@submit");
             self::post("$path/edit/:id", "$controller@edit");
             self::post("$path/save/:id", "$controller@save");
             self::post("$path/delete/:id", "$controller@delete");
       }



       /**
        * Add routes group
        * 
        * @param array $options
        * @param Closure $callback
        * @return void
       */
       public static function group($options = [], \Closure $callback)
       {  
           RouteHandler::addOptions($options);
           call_user_func($callback);
           $options = [];
       }


	    /**
	     * Add routes by request GET
	     * @param string $path 
	     * @param mixed $callback 
	     * @param string $name 
	     * @return RouteObject
	    */
  	   public static function add(
  	     	$path, 
  	     	$callback, 
  	      $name = null,  
  	      $method = 'GET'
  	   )
  	   {
             
              $route = new RouteHandler($path, $callback, $name, $method);
              $route->beforeStore();
              RouteCollection::store($route);
              return $route;
  	    }



        /**
          * Get URL Named route
          * @param string $name 
          * @param array $params 
          * @return string
         */
         public static function url(string $name, array $params = [])
         {
              return RouteHandler::url($name, $params);
         }




}