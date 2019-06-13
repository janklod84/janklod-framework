<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Router
*/ 
class Router
{
       

/**
 * @var  array        $params
 * @var  array        $matches
 * @var  array        $routes
 * @var  RouteParam   $route
 * @var  Dispatcher   $dispatcher
 * @var  string       $url
*/
private $params  = [];
private $matches = [];
private $routes  = [];
private $route;
private $url;



/**
 * Constructor
 * 
 * @param string $url 
 * @return void
*/
public function __construct($url = '')
{
      $this->addUrl($url);
}


/**
 * Add Url
 * 
 * @param  string $url 
 * @return void
*/
public function addUrl($url='')
{
	 $this->url = trim($url, '/');
}



/**
 * Determine if route match URL
 * 
 * @param string $url 
 * @param string $method 
 * @return array|bool
 */
public function match($url=null, $method=null)
{
   foreach(RouteCollection::group($method) as $route)
   {
       $pattern = $route->convertPattern();
       if(preg_match($pattern, $url, $matches))
       {
           array_shift($matches);
           $this->matches = $matches;
           $this->route = $route;
           return $route->parameters();
       }
   }
   return false;
}



/**
 * Dispatching routes
 * 
 * @param  string $method
 * @return Dispatcher
*/
public function run($method='GET')
{
    if($this->match($this->url, $method))
    {
    	 return new Dispatcher(
    	           $this->route->callback(), 
                   $this->matches
               );
    }else{
    	return new Dispatcher('NotFoundController@page404');
    }
}


/**
 * Get request method
 * 
 * @return string
*/
public function requestMethod($parsed)
{
   if(is_null($parsed))
   {
   	  return $_SERVER['REQUEST_METHOD'] ?? '';
   }
}


/**
 * Get url
 * 
 * @return string
*/
public function url($parsed)
{
   if(is_null($parsed))
   {
   	  return $_SERVER['REQUEST_URI'] ?? '';
   }
}



/**
 * Get route params
 * 
 * @return array
*/
public function params()
{
     return $this->params;
}


/**
 * Get matches params
 * 
 * @return array
*/
public function matches()
{
     return $this->matches;
}


}