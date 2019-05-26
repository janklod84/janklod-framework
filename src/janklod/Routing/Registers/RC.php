<?php 
namespace JK\Routing\Registers;


/**
 * Route Handler
 * @package JK\Routing\Registers\RouteCustomer
*/ 
class RouteCustomer
{
       
/**
 * @var array  $regex  [ Route regex  ]
 * @var array  $params [ Route params ]
 * @var array  $namedRoutes [ Named Routes ]
*/ 
private $regex = [];
private $params = [];
private static $namedRoutes = [];


/**
 * Set Path
 * @param string $path
 * @return void
*/
public function path($path)
{
    $this->params['path'] = 
    $this->preparePath(trim($path, '/'));
}


/**
 * Set callback
 * @param string $callback
 * @return void
*/
public function callback($callback)
{
    $this->params['callback'] = $callback;
}


/**
 * Set Name
 * @param string $name
 * @return void
*/
public function name($name)
{
    $this->params['name'] = $name;
}


/**
 * Set method
 * @param string $method
 * @return void
*/
public function method($method)
{
    $this->params['method'] = $method;
}


/**
 * Set prefix
 * @param string $prefix
 * @return void
*/
public function prefix($prefix)
{
    $this->params['prefix'] = $prefix;
}


/**
 * Get param
 * @param string $key 
 * @return mixed
*/
public function get($key)
{
    if($this->hasParam($key))
    {
    	 return $this->params[$key];
    }
    return null;
}


/**
 * Determine if has param
 * @param string $key 
 * @return bool
*/
public function hasParam($key): bool
{
	return isset($this->params[$key]);
}

/**
 * Get route parameters
 * @return array
*/
public function parameters()
{
	return $this->params ?? [];
}


/**
 * Before storage
 * @return void
*/
public function beforeStorage()
{
	 if(is_string($this->get('callback'))
	 	&& $this->get('name') === null)
	 {
          $this->name(
          	 $this->get('callback')
          );
	 }

	 if($name = $this->get('name'))
	 {
         $this->namedRoute($name);
	 }

	 $this->prepareCallback();
}


/**
* Add name of route
* @param string $name 
* @return void
*/
public function namedRoute($name)
{
    self::$namedRoutes[$name] = $this;
}


/**
 * prepare callback
 * @param mixed $callback 
 * @return 
*/
private function prepareCallback()
{
	$callback = $this->get('callback');
	if(is_string($this->get('callback')))
	{
		 if(strpos($this->get('callback'), '@') !== false)
	     {
		      list($controller, $action) = 
		      explode('@', $this->get('callback'));
		      $callback = [
                 'controller' => $this->prepareController($controller),
                 'action'     => $action
		      ];
	     }
	}
    $this->callback($callback);
}

/**
* Get controller if with or without prefix
* @param string $controller 
* @return string
*/
private function prepareController($controller)
{
	if($prefix = $this->getPrefix('controller'))
	{
		   $controller = $prefix.'\\'. $controller; 
	}
	return $controller;
}

/**
 * Prepare path
 * @param string $path 
 * @return string
*/
private function preparePath($path)
{
  echo $this->getPrefix('path');
 if($prefix = $this->getPrefix('path'))
 {
 	  $path = trim($prefix, '/').'/'. $path;
 }
 
 //return sprintf('^%s$', trim($path, '/'));
}


/**
 * Get prefix
 * @param string $name 
 * @return mixed
*/
private function getPrefix($name)
{
	 $prefix = $this->get('prefix');
	 if(isset($prefix[$name]))
	 {
	 	 return $prefix[$name];
	 }
	 return null;
}
}