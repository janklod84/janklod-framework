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
 * @var \JK\Routing\Dispatcher
 * @var string $url
*/
private $matches = [];
private $routes  = [];
private $route;
private $dispatcher;
private $url;



/**
 * Constructor
 * @param string $url 
 * @return void
*/
public function __construct($url = '')
{
      $this->addUrl($url);
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
public function addUrl($url)
{
     $this->url = trim($url, '/');
}



/**
 * Get url
 * @return string
*/
public function url()
{
   return $this->url;
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
 * Dispatcher routes
 * @param string $method 
 * @return \JK\Routing\Dispatcher
*/
public function dispatch($method='GET')
{
   // debug($this->routes);

    if($this->match($method))
    {
          // debug($this->route);
          if(is_null($this->dispatcher))
          {
              $this->dispatcher = new Dispatcher(
                 $this->route['callback'], 
                 $this->matches
              );
          }
    }
    return $this->dispatcher;
}



/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function match($method='')
{
    $method = $method ?: $_SERVER['REQUEST_METHOD'];
    foreach($this->routes($method) as $route)
    {
        debug($this->routes($method));
        $this->route = $route;
        return true;
        /*
	      if(!preg_match($this->url, $route['path'], $matches))
        {
	            return false;
        }
        
        array_shift($matches);
        $this->matches = $matches;
        $this->route   = $route;
        return true;
        */
    }
}


public function mk()
{
  $method = $method ?: $_SERVER['REQUEST_METHOD'];
  foreach($this->routes($method) as $route)
  {
      // debug($route['path']);
      $this->route = $route;
      return true;
      /*
      if(!preg_match($this->url, $route['path'], $matches))
      {
            return false;
      }
      
      array_shift($matches);
      $this->matches = $matches;
      $this->route   = $route;
      return true;
      */
    }
}


/**
 * Determine if parsed url match current route
 * @param string $url 
 * @return bool
*/
/*
public function matched($url='')
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

 private function replacePattern()
 {
      return preg_replace_callback('#:([\w]+)#', 
                     [$this, 'paramMatch'], 
                     $this->get('path')
            );
 }

*/



}