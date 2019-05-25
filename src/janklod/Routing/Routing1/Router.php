<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\Router
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
         * Constructor
         * @param string $url 
         * @return void
        */
  	    public function __construct($url = '')
  	    {
              $this->url = trim($url, '/');
              $this->routes = RouteCollection::all();
  	    }

       
        
        /**
         * Map matched route 
         * @param string $method
         * @return 
        */
  	    public function dispatch($method = null)
  	    {
              if(!isset($this->routes[$method]))
              {
                  exit('Not Found routes!');
              }

              foreach($this->routes[$method] as $route)
              {
                   if($route->match($this->url))
                   {
                        return new Dispatcher($route);
                   }
              }

              exit('No matches routes!');
  	    }
}