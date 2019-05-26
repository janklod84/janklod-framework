<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\Router
*/ 
class Router
{
       

/**
 * @var array  $matches
 * @var array  $routes
 * @var array  $route
 * @var string $url
*/
private $matches = [];
private $routes = [];
private $route;
private $url;



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



public function run()
{
   debug($this->routes);
}



/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function matched()
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

/**
 * Determine if parsed url match current route
 * @param string $url 
 * @return bool
*/
public function match($url)
{
     $url   = trim($url, '/');
     $path  = $this->replacePattern();
     $regex = "#^$path$#i";

     if(!preg_match($regex, $url, $matches))
     {
          return false;
     }
    
     array_shift($matches);
     $this->set('matches', $matches);
     return true;
}



/**
  * Return match param
  * @param string $match 
  * @return string 
*/
public function paramMatch($match)
{
     if(isset($this->regex[$match[1]]))
     {
          return '('. $this->regex[$match[1]] . ')';
     }
     return '([^/]+)';
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




}