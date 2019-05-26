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
public function setPath($path)
{
    $this->params['path'] = 
    $this->preparePath($path);
}


/**
 * Set Path
 * @param string $path
 * @return void
*/
public function getPath()
{
    return $this->params['path'];
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
 * get Path
 * @param string $path
 * @return void
*/
public function getCallback()
{
    return $this->params['path'];
}



/**
 * Set Name
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
 * Set prefix
 * @param string $prefix
 * @return void
*/
public function setPrefix($prefix)
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
          $this->setName(
          	 $this->get('callback')
          );
	 }

	 if($name = $this->get('name'))
	 {
         $this->addNamedRoute($name);
	 }

	 $this->prepareCallback();
}


/**
* Add name of route
* @param string $name 
* @return void
*/
public function addNamedRoute($name)
{
    self::$namedRoutes[$name] = $this;
}

/**
 * Prepare path
 * @param string $path 
 * @return string
*/
private function preparePath($path)
{
   return sprintf('^%s$', trim($path, '/'));
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
		      list($controller, $action) = explode('@', $this->get('callback'));
		      $callback = [
                 'controller' => $controller,
                 'action'     => $action
		      ];
	     }
	}
    $this->setCallback($callback);
}


}