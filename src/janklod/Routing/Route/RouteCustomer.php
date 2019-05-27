<?php 
namespace JK\Routing\Route;


/**
 * This class is a handler of route
 * @package JK\Routing\Route\RouteCustomer
*/ 
class RouteCustomer
{
       
/**
 * @var array  $regex   [ Route regex  ]
 * @var array  $params  [ Route params ]
 * @var array  $options [ Route options ]
 * @var array  $namedRoutes [ Named Routes ]
*/ 
private $regex   = [];
private $params  = [];
private $options = [];
private static $namedRoutes = [];


/**
 * Add Params
 * @param array $options 
 * @return void
*/
public function addParams($params=[])
{
   $this->params = array_merge($this->params, $params);
}

/**
 * Set option
 * @param array $options 
 * @return void
 */
public function addOptions($options)
{
	 $this->options = $options;
}


/**
 * Set param
 * @param string $key 
 * @param mixed $value 
 * @return void
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
 * add option in params
 * @param string $path
 * @return void
*/
public function setOption($key)
{
	  $this->params[$key] = $this->getOption($key);
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
  * Return match param
  * @param string $match 
  * @return string 
*/
public function paramMatch($match)
{
     if(isset($this->regex[$match[1]]))
     {
          return '('. $this->regex[$match[1]] . ')';
     }
     return '([^/]+)';
}


/**
  * Replace param in path
  * 
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @param string $replace 
  * @param callable $callback 
  * @return string
*/
 public function replacePattern($path)
 {
      return preg_replace_callback(
                     '#:([\w]+)#', 
                     [$this, 'paramMatch'], 
                     $path
            );
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
	      $this->setParam('callback', $callback);
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
* @param mixed $parameter 
* @param mixed $regex 
* @return $this
*/
public function with($parameter, $regex = null)
{
   if(is_array($parameter) && is_null($regex))
   {
      foreach($parameter as $index => $exp)
      {
           # recursive
           $this->with($index, $exp);
      }

   }else{
       $this->regex[$parameter] = str_replace('(', '(?:', $regex);
   }
   
   $this->setParam('regex', $this->regex);
   return $this;
}



/**
 * Get Url
 * @param string $name 
 * @param array $params 
 * @return mixed
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