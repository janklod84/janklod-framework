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
 * Constructor
 * @param string $path 
 * @param mixed $callback 
 * @param string $name 
 * @param string $method 
 * @return void
*/
public function __construct($params)
{
	 $this->params = $params;
}



/**
 * Before storage
 * @return void
*/
public function beforeStorage()
{
	 // Filter route
	 if(is_string($this->getParam('callback'))
	 	&& $this->getParam('name') === null)
	 {
        $this->setParam('name', $this->getParam('callback'));
	 }

	 if($name = $this->getParam('name'))
	 {
          $this->namedRoute($name);
	 }

	 // set real params
	 // $this->setParam('path', 
	 // 	$this->preparePath()
	 // );


}



/**
 * Set Param
 * @param string $value
 * @return void
*/
public function setParam($key, $value)
{
    $this->params[$key] = $value;
}

/**
 * Get param
 * @param string $key 
 * @return mixed
*/
public function getParam($key='')
{
	 if($key !== '')
	 {
	 	 if($this->hasParam($key))
	 	 {
	 	 	return $this->params[$key];
	 	 }
	 	 return null;
	 }
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
private function prepareCallback($callback)
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
	     }
	}
    return $callback;
}

/**
* Get controller if with or without prefix
* @param string $controller 
* @return string
*/
private function getController($controller)
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
private function preparePath()
{
	 $path = $this->getParam('path');
	 if($prefix = $this->getPrefix('path'))
	 {
	 	  $path = trim($prefix, '/').'/'. $path;
	 }
	 return sprintf('^%s$', $path);
}


/**
 * Get prefix
 * @param string $name 
 * @return mixed
*/
private function getPrefix($name)
{
	 $prefix = $this->getParam('prefix');
	 if(isset($prefix[$name]))
	 {
	 	 return $prefix[$name];
	 }
	 return 'default-prefix';
}


}