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
private $routes  = [];
private $route;
private $url;



/**
 * Constructor
 * @param string $url 
 * @return void
*/
public function __construct($url = '')
{
      $this->setUrl($url);
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
 * Set Url
 * @param string $url
 * @return void
*/
public function setUrl($url)
{
     $this->url = trim($url, '/');
}



/**
 * Get routes
 * @return array
*/
public function routes($method='')
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
public function route()
{
    return $this->route;
}


/**
 * Run routing
 * @return mixed
*/
public function dispatched($method='')
{
  $routes = $this->getRoutes($method);
  foreach($routes as $route)
  {
         $this->route = $route;
  }

  return $this;
}



/**
 * Dispatcher routes
 * @param string $method 
 * @return \JK\Routing\Dispatcher
*/
public function dispatch($method='')
{
   debug($this->routes);

   /* return new Dispatcher($callback, $matches); */
}



/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function isMatched()
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
 * Determine if parsed url match current route
 * @param string $url 
 * @return bool
*/
public function match($url='')
{
     $url   = $url ?: $this->url;
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
  * Replace param in path
  * 
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @param string $replace 
  * @param callable $callback 
  * @return string
*/
 private function replacePattern()
 {
      return preg_replace_callback('#:([\w]+)#', 
                     [$this, 'paramMatch'], 
                     $this->get('path')
            );
 }





}