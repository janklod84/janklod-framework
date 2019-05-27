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
private $params  = [];
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
 * Determine if route match URL
 * @param string $regex
 * @return bool
*/
public function match($regex='')
{
    if(!preg_match($regex, $this->url, $matches))
    {
          return false;
    }
    array_shift($matches);
    $this->matches = $matches;
    return true;
}



/**
 * Dispatcher routes
 * @param string $method 
 * @return \JK\Routing\Dispatcher
*/
public function dispatch($method='GET')
{
    $method = $method ?: $_SERVER['REQUEST_METHOD'];

    foreach($this->routes($method) as $route)
    {
        if($this->match($route->replacePattern()))
        {
              $this->route  = $route;
              $this->params = $route->parameters();

              if(is_null($this->dispatcher))
              {
                  $this->dispatcher = new Dispatcher(
                     $route->param('callback'), 
                     $this->matches
                  );
              }
       }
    }
    return $this->dispatcher;
}



/**
 * Get url
 * @return string
*/
public function params()
{
    return $this->params ?: [];
}



}