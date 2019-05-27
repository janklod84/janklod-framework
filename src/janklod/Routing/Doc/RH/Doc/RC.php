<?php 
namespace JK\Routing\Route;


/**
 * This class is a handler of route
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
public function path($path)
{
	$this->params['path'] = $this->preparePath($path);
}


/**
 * Set param
 * @param type $key 
 * @param type $value 
 * @return type
 */
public function setParam($key, $value)
{
	$this->params[$key] = $value;
}


/**
 * Set regex in params
 * @param string $param
 * @param mixed $regex
 * @return void
*/
public function regex($param, $regex)
{
	$this->regex[$param] = $regex;
}


/**
 * Set regex
 * @param string $regex 
 * @return void
*/
public function getRegex()
{
	 return $this->regex;
}


/**
 * Add regex
 * @param string $regex 
 * @return void
*/
public function addRegex($regex)
{
	 $this->params['regex'] = $regex;
}


/**
 * add option in params
 * @param string $path
 * @return void
*/
public function option($key)
{
	$this->params[$key] = $this->getOption($key);
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
 * Set name 
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
public function method($method='GET')
{
	$this->params['method'] = $method;
}




/**
 * Get param
 * @param string $key 
 * @return mixed
*/
public function param($key='')
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
 	  	  $path = sprintf('%s/%s', trim($prefix, '/'), $path);
	 }

	 return sprintf('#^%s$#i', trim($path, '/'));
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
 * prepare and map callback
 * @param mixed $callback 
 * @param string $divider '@'
 * @return 
*/
public function mapCallback($callback, $divider='@')
{
  if(is_string($callback))
  {
	 if(strpos($callback, $divider) !== false)
	 {
	      list($controller, $action) = 
	      explode($divider, $callback);
	      $callback = [
	         'controller' => $this->getController($controller),
	         'action'     => $action
	      ];
	      $this->callback($callback);
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


/**
* Add regex
* @param mixed $param 
* @param mixed $regex 
* @return $this
*/
public function with($param, $regex = null)
{
	 if(is_array($param) && is_null($regex))
	 {
		  foreach($param as $index => $exp)
		  {
		       # recursive
		       $this->with($index, $exp);
		  }

	 }else{
	     
	     $this->regex(
	     	$param, 
	     	str_replace('(', '(?:', $regex)
	     );
	 }
	 
	 $this->setParam('regex', $this->regex);
	 return $this;
}


/**
 * Get Url
 * @param type $name 
 * @param type|array $params 
 * @return type
*/
public static function url($name, $params = [])
{
     if(!isset(self::$namedRoutes[$name]))
     {
           return false;
     }

     return self::$namedRoutes[$name]->getUrl($params);
}




/**
  * Get Url
  * @param array $params 
  * @return string
*/
private function getUrl($params)
{
    $path = $this->param('path');

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
}


}