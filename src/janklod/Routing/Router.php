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
             echo '<h2>All Routes</h2>';
             debug($this->routes);
             
             echo '<h2>Route params</h2>';
             foreach($this->routes[$method] as $route)
             {
                  debug($route->parameters());
             }
  	    }
}