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
 * @var mixed $route
*/
private $routes = [];
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
 * Add route
 * @param array $routes 
 * @return void
*/
public function addRoute($routes=[])
{
     $this->routes = $routes;
}


/**
 * Get routes
 * @return array
*/
public function getRoutes($method='')
{
	if($method !== '')
	{
		if(!isset($this->routes[$method]))
		{
			 exit(
			 	sprintf('Method <strong>%s</strong> does not match!', $method)
			 );
		}
		return $this->routes[$method];
	}
    return $this->routes;
}


/**
 * Run routing
 * @return mixed
*/
public function getRoute()
{
    return $this->route;
}



/**
 * Run routing
 * @return mixed
*/
public function dispatch($method='')
{
	$routes = $this->getRoutes($method);
	foreach($routes as $route)
	{
         $this->route = $route;
	}

	return $this;
}


/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function match()
{
    foreach($this->routes as $pattern => $route)
    {
	  if(!preg_match($this->url, $route['path'], $matches))
      {
	        return false;
      }

      return true;
    }
}


/**
 * @return 
*/
public function dispatcher($callback, $matches=[])
{
    return new Dispatcher($callback, $matches);
}


}