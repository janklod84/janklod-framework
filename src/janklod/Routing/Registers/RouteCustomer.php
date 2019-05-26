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
public function preparePath($path)
{
	 $path = trim($path, '/');
	 if($prefix = $this->getOption('prefix.path'))
	 {
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
public function setMethod($method)
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
* Add name of route
* @param string $name 
* @return void
*/
public function namedRoute($name)
{
    self::$namedRoutes[$name] = $this;
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
        $this->setName($this->getParam('callback'));
	 }

	 if($name = $this->getParam('name'))
	 {
          $this->namedRoute($name);
	 }
     $this->prepareCallback();
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
    	$key  = $part[0];
        if(array_key_exists($key, $this->options))
        {
             $result = $this->options[$key];
             foreach($part as $item)
             {
                  if(isset($result[$item]))
                  {
                  	 $result = $result[$item];
                  }
             }

             return $result;
        }
    }
}



/**
 * prepare callback
 * @param mixed $callback 
 * @return 
*/
public function prepareCallback()
{
	if(is_string($this->getParam('callback'))
       && strpos($this->getParam('callback'), '@') !== false
     )
	{
		      list($controller, $action) = 
		      explode('@', $this->getParam('callback'));
		      $callback = [
                 'controller' => $this->getController($controller),
                 'action'     => $action
		      ];
		      $this->setCallback($callback);
	}
}

/**
* Get controller if with or without prefix
* @param string $controller 
* @return string
*/
public function getController($controller)
{
	 if($prefix = $this->getOption('prefix.controller'))
     {
 	     $controller = $prefix.'\\'. $controller; 
     }
     return $controller;
}	




}