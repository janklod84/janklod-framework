<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteParam 
*/
class RouteParam 
{
	 
/**
* @var  string  $path         [ Route path        ]
* @var  mixed   $callback     [ Route callback    ]
* @var  string  $name         [ Route name        ]
* @var  string  $method       [ Route method      ]
* @var  string  $module       [ Route module      ]
* @var  array   $regex        [ Route regex       ]
* @var  array   $prefixes     [ Route prefixes    ]
* @var  array   $middlewares  [ Route middlewares ]
* @var  array   $namedRoutes  [ Named routes      ]
*/
private $path;
private $callback;
private $name;
private $method;
private $module;
private $regex = [];
private $prefixes = [];
private $middlewares = [];
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
 * Set callback
 * 
 * @param string $callback 
 * @return void
*/
public function setCallback($callback)
{
    $this->callback = $callback;
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
 * Get Url
 * RouteParameter::url('named.route', 
 * ['param1' => value1, 'param2' => value2 ...]
 * )
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
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @return string
*/
public function pattern()
{
    return preg_replace_callback('#:([\w]+)#', 
      [$this, 'paramMatch'], $this->path
   );
}


/**
 * Determine if has item Regex
 * 
 * @param string $key 
 * @return bool
*/
private function has($key)
{
    return isset($this->regex[$key]);
}

/**
  * Return match param
  * @param string $match 
  * @return string 
*/
private function paramMatch($match)
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
private function getUrl($params)
{
    $path = $this->path;

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
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



}