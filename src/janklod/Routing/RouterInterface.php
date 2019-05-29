<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouterInterface 
*/ 
interface RouterInterface
{
      
/**
* Add route in container routes
* @param array $routes [all routes]
* @return void
*/
public function addRoute($routes);


/**
* Add Url
* @param string $url
* @return void
*/
public function addUrl($url);



/**
* Determine if route match URL
* May take parameters
* @param string ...$args
* @return bool
*/
public function match(...$args): bool;


/**
* Dispatcher
* @param string ...$args
* @return mixed
*/
public function dispatch(...$args);




}