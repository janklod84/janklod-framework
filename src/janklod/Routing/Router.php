<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Router
*/ 
class Router
{
       

/**
 * @var array  $params
 * @var array  $matches
 * @var array  $routes
 * @var object $route
 * @var \JK\Routing\Dispatcher $dispatcher
 * @var string $url
*/
private $params  = [];
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
public function addRoutes($routes)
{
     $this->routes = $routes;
}


/**
 * Add Url
 * @param string $url
 * @return void
*/
public function addUrl($url)
{
     $this->url = trim($url, '/');
}



/**
 * Get routes
 * @param string $method
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
 * @param string $pattern
 * @return bool
*/
public function match($pattern): bool
{
    if(!preg_match($pattern, $this->url, $matches))
    {
          return false;
    }
    array_shift($matches);
    $this->matches = $matches;
    return true;
}



/**
 * Dispatching routes
 * @param string $method
 * @return null | \JK\Routing\Dispatcher
*/
public function dispatch($method='GET')
{
    foreach($this->routes($method) as $route)
    {
        if($this->match($route->replacePattern()))
        {
              $this->route  = $route;
              $this->params = $route->parameters();
              if(is_null($this->dispatcher))
              {
                  $this->dispatcher = new Dispatcher(
                     $route->getParam('callback'), 
                     $this->matches
                  );
              }
       }
    }
    return $this->dispatcher;
}


/**
 * Get route params
 * @return array
*/
public function parameters()
{
    return $this->params ?: [];
}


/**
 * Get matches params
 * @return array
*/
public function matches()
{
    return $this->matches ?: [];
}


}