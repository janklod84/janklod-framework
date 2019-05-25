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
*/
private $routes = [];



/**
 * Constructor
 * @param string $url 
 * @return void
*/
public function __construct($url = '')
{
      $this->url = trim($url, '/');
      // $this->routes = RouteCollection::all();
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
public function getRoutes()
{
    return $this->routes;
}



/**
 * Determine if route match URL
 * @param string $url 
 * @return bool
*/
public function isMatch($url='')
{

}



public function run()
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