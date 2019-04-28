<?php 
namespace JK\Routing;



/**
 * @package JK\Routing
*/ 
class Router
{
       

        /**
         * @var string $url
        */
        private $url;

        

        /**
         * @var array
        */
        private $routes = [];
       

        
        /**
         * current route
         * @var mixed
        */
        private $route;



        /**
         * Constructor
         * @param string $url 
         * @return void
        */
  	    public function __construct($url = '')
  	    {
              $this->url = trim($url, '/');
  	    }

       
        /**
         * Add all routes as array
         * @param array $routes 
         * @return void
        */
        public function addRoutes($routes = [])
        {
             $this->routes = $routes;
        }


	     /**
         * Get routes
         * @param string $method
         * @return array
        */
  	    public function getRoutes($method = null)
  	    {
              $this->routes = $this->routes ?: RouteCollection::all();

              if(!is_null($method))
              {
                  if(!isset($this->routes[$method]))
                  {
                        return false;
                  }

                  return $this->routes[$method];
              }

              return $this->routes;
  	    }

        
        /**
         * Map matched route 
         * @param string $method
         * @return 
        */
  	    public function dispatch($method = null)
  	    {
              if(!$this->getRoutes($method))
              {
                  exit('Not Found routes!');
              }

              foreach($this->getRoutes($method) as $route)
              {
                   if($route->match($this->url))
                   {
                        $this->route = $route;
                        return new Dispatcher($route);
                   }
              }
              
              exit('No matches routes!');

  	    }
}