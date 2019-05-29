<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\Router
*/ 
class Router implements RouterInterface
{
       

/**
 * @var array  $params
 * @var array  $matches
 * @var array  $routes
 * @var array  $route
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
public function addRoute($routes)
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
 * @param string ...$args
 * @return bool
*/
public function match(...$args): bool
{
    $pattern = $args[0];
    $regex = '#^'. $pattern . '$#i';
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
 * @param string ...$args 
 * @return null | \JK\Routing\Dispatcher
*/
public function dispatch(...$args)
{
    $method = $args[0] ?: 'GET';
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
 * Get route params
 * @return array
*/
public function params()
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


/**
 * Transform name to CamelCase
 * @param string $name string for transform
 * @return string
*/
protected static function upperCamelCase($name) 
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}

  
/**
 * Transform name to lowerCase 
 * Ex: name => Name
 * @param string $name string for transform
 * @return string
*/
protected static function lowerCamelCase($name) 
{
   return lcfirst(self::upperCamelCase($name));
}


/**
 * Return string without GET parameters
 * @param string $url request URL
 * @return string
*/
protected static function removeQueryString($url='') 
{
    $url = $url ?: $this->url;
    if($url)
    {
        $params = explode('&', $url, 2);
        if(false === strpos($params[0], '='))
        {
            return rtrim($params[0], '/');
        }else{
            return '';
        }
    }
}


}