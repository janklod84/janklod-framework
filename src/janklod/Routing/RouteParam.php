<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteParam 
*/
class RouteParam 
{
	 
/**
* @var  string  $path         [ Route path        ]
* @var  string  $pattern      [ Route pattern     ]
* @var  mixed   $callback     [ Route callback    ]
* @var  string  $name         [ Route name        ]
* @var  string  $method       [ Route method      ]
* @var  string  $module       [ Route module      ]
* @var  array   $regex        [ Route regex       ]
* @var  array   $middlewares  [ Route middlewares ]
* @var  array   $params       [ Route params      ]
* @var  array   $namedRoutes  [ Named routes      ]
*/
private $path;
private $pattern;
private $callback;
private $name;
private $method;
private $module;
private $regex = [];
private $middlewares = [];
private $params = [];
private static $namedRoutes = [];


/**
 * Constructor
 * 
 * @param   string   $path 
 * @param   string   $callback 
 * @param   string   $name 
 * @param   string   $method 
 * @return  void
 */
public function __construct($path, $callback, $name=null, $method='GET')
{
   $this->setPath($path);
   $this->setPattern($path);
   $this->setCallback($callback);
   $this->setName($name);
   $this->setMethod($method);
}


/**
 * Set path
 * 
 * @param string $path 
 * @return void
*/
public function setPath($path)
{
    $this->path = $path;
    $this->item('path', $this->path);
}


/**
 * Get path
 * 
 * @return string
*/
public function path()
{
    return $this->path;
}



/**
 * Set pattern
 * 
 * @param string $pattern 
 * @return void
*/
public function setPattern($pattern)
{
    $this->pattern = '#^'. $pattern . '$#i';
    $this->item('pattern', $this->pattern);
}


/**
 * Get pattern
 * 
 * @return string
*/
public function pattern()
{
    return $this->pattern;
}



/**
 * Set callback
 * 
 * @param string $callback 
 * @return void
*/
public function setCallback($callback)
{
    $this->callback = $callback;
    $this->item('callback', $this->callback);
}


/**
 * Get callback
 * 
 * @return string
*/
public function callback()
{
    return $this->callback;
}


/**
 * Set method
 * 
 * @param string $method 
 * @return void
*/
public function setMethod($method)
{
    $this->method = $method;
    $this->item('method', $this->method);
}


/**
 * Get request method
 * 
 * @return string
*/
public function method()
{
    return $this->method;
}


/**
 * Set name
 * 
 * @param string $name 
 * @return void
*/
public function setName($name)
{
    $this->name = $name;
    $this->item('name', $this->name);
}


/**
 * Get name
 * 
 * @return string
*/
public function name()
{
    return $this->name;
}



/**
 * Add middleware
 * 
 * @param array $middlewares 
 * @return void
*/
public function addMiddleware($middlewares)
{
     $this->middlewares = $middlewares;
     $this->item('middlewares', $this->middlewares);
}




/**
 * Get middleware
 * 
 * @param  $key 
 * @return string
*/
public function middleware($key)
{
     return $this->middlewares[$key] ?? null;
}


/**
 * Add module
 * 
 * @param string $module
 * @return void
*/
public function addModule($module)
{
    $this->module = $module;
    $this->item('module', $this->module);
}



/**
 * Get module
 * 
 * @return string
*/
public function module()
{
     return $this->module;
}



/**
 * Get item params
 * @return array
*/
public function parameters()
{
    return $this->params;
}


/**
 * Set item param
 * 
 * @param string $key 
 * @param mixed $value 
 * @return void
*/
public function item($key, $value)
{
     $this->params[$key] = $value;
}

/**
 * Get param item
 * 
 * @param string $key 
 * @return mixed
*/
public function param($key)
{
   return $this->params[$key] ?? null;
}


/**
 * Add named routes
 * 
 * @param string $name 
 * @return void
*/
public function namedRoutes($name)
{
   self::$namedRoutes[$name] = $this;
}



/**
 * Do somes actions before storage
 * 
 * @return void
*/
public function beforeStorage()
{
  if(is_string($this->callback) && $this->name === null)
  {
     $this->setName($this->callback);
  }

  if($this->name)
  {
     $this->namedRoutes($this->name);
  }
}


/**
* Add regex
* 
* @param mixed $parameter 
* @param mixed $regex 
* @return self
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

   return $this;
}




/**
  * Replace param in path
  * 
  * @return string
*/
public function convertPattern()
{
    return preg_replace_callback('#:([\w]+)#', 
      [$this, 'paramMatch'], $this->pattern
   );
}



/**
 * Get Url
 * 
 * @param string $name 
 * @param array $params 
 * @return string
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
 * Determine if has item Regex
 * 
 * @param string $key 
 * @return bool
*/
protected function has($key)
{
    return isset($this->regex[$key]);
}



/**
  * Return match param
  * 
  * @param array $match 
  * @return string 
*/
protected function paramMatch($match)
{
     if($this->has($match[1]))
     {
          return '('. $this->regex[$match[1]] . ')';
     }
     return '([^/]+)';
}


/**
  * Get Url
  * 
  * @param array $params 
  * @return string
*/
protected function getUrl($params)
{
    $path = $this->path;

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
}


}