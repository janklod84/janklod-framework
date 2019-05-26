<?php 
namespace JK\Routing\Route;


/**
 * Route Handler
 * @package JK\Routing\Route\RouteCustomer
*/ 
class RouteCustomer
{
       
/**
 * @var array  $regex  [ Route regex  ]
 * @var array  $params [ Route params ]
 * @var array  $namedRoutes [ Named Routes ]
*/ 
private $regex   = [];
private $params  = [];
private $options = [];
private static $namedRoutes = [];


/**
 * Constructor
 * @param array $options
 * @return void
*/
public function __construct($options=[])
{
	 $this->options = $options;
}


/**
 * Set path param
 * @param string $path
 * @return void
*/
public function setPath($path)
{
	$this->params['path'] = $this->preparePath($path);
}


/**
 * Prepare path
 * @param string $path 
 * @return string
*/
public function preparePath(string $path)
{
	 $path = trim($path, '/');
	 if($this->hasOption('prefix.path'))
	 {
	 	  $prefix = $this->getOption('prefix.path');
 	  	  $path = trim($prefix, '/').'/'. $path;
	 }

	 return sprintf('^%s$', trim($path, '/'));
}



/**
 * add option in params
 * @param string $path
 * @return void
*/
public function setOption($key)
{
	$this->params[$key] = $this->getOption($key);
}


/**
 * Set callback
 * @param string $callback
 * @return void
*/
public function setCallback($callback)
{
	$this->params['callback'] = $callback;
}



/**
 * Set name 
 * @param string $name
 * @return void
*/
public function setName($name)
{
	$this->params['name'] = $name;
}



/**
 * Set method 
 * @param string $method
 * @return void
*/
public function setMethod($method='GET')
{
	$this->params['method'] = $method;
}




/**
 * Get param
 * @param string $key 
 * @return mixed
*/
public function getParam($key='')
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
* Add named  route
* @param string $name 
* @return void
*/
public function namedRoute($name)
{
    self::$namedRoutes[$name] = $this;
}


/**
 * Determine if has option
 * @param string $parsed 
 * @return bool
*/
public function hasOption($parsed='')
{
    $part = explode('.', $parsed);
    return ! empty($this->options[$part[0]][$part[1]]);
}


/**
* Get option
* @param string $parsed 
* @return mixed
*/
public function getOption($parsed='')
{
	if($parsed)
	{
		$part = explode('.', $parsed);
		$parent  = $part[0];
		$result = null;
	    if(array_key_exists($parent, $this->options))
	    {
	         $result = $this->options[$parent];
	         foreach($part as $item)
	         {
             	 if(isset($result[$item]))
                 {
         	        $result = $result[$item];
                 }
	         }
	    }
        return $result;
	}
}



/**
 * prepare callback
 * @param mixed $callback 
 * @return 
*/
public function prepareCallback($callback)
{
  if(is_string($callback))
  {
	 if(strpos($callback, '@') !== false)
	 {
	      list($controller, $action) = 
	      explode('@', $callback);
	      $callback = [
	         'controller' => $this->getController($controller),
	         'action'     => $action
	      ];
	      $this->setCallback($callback);
	 }
  }
}

/**
* Get controller if with or without prefix
* @param string $controller 
* @return string
*/
public function getController($controller)
{
 	if($this->hasOption('prefix.controller'))
 	{
 		$prefix = $this->getOption('prefix.controller');
        $controller = $prefix.'\\'. $controller; 
 	}
 	return $controller;
}	




}