<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Router
*/ 
class Router
{
       

/**
 * @var  array       $params
 * @var  array       $matches
 * @var  array       $routes
 * @var  object      $route
 * @var  Dispatcher  $dispatcher
 * @var  string      $url
*/
private $params  = [];
private $matches = [];
private $routes  = [];
private $route;
private $dispatcher;
private $url;



/**
 * Constructor
 * 
 * @param string $url 
 * @return void
*/
public function __construct($url = '')
{
      
}



/**
 * Determine if route match URL
 * 
 * @return 
*/
public function match()
{
     
}



/**
 * Dispatching routes
 * 
 * @param  string $method
 * @return Dispatcher
*/
public function dispatch($method='GET')
{
      echo '<pre>';
      print_r(RouteCollection::all());
      echo '</pre>';
}


/**
 * Get route params
 * 
 * @return array
*/
public function params()
{
    
}


/**
 * Get matches params
 * 
 * @return array
*/
public function matches()
{
    
}


}