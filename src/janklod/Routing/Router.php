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
public function run()
{
}


/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function isMatch()
{
    return $this->route 
                ->match($this->url);
}


/**
 * Get route params
 * @return type
 */
public function params()
{
	return $this->route 
	            ->parameters();
}


/**
 * Dispatch all routes
 * @return mixed
*/
public function dispatched($method='')
{

}


/**
 * @return 
*/
public function dispatch($callback, $matches=[])
{
    return new Dispatcher($callback, $matches);
}


}