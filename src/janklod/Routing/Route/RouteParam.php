<?php 
namespace JK\Routing\Route;


/**
 * Route Params
 * 
 * @package JK\Routing\Route\RouteParam
*/ 
class RouteParam
{
   
/**
 * @var array $params      [ Contain Route Params ]
 * @var array $regex       [ Contain Route Regex  ]
 * @var array $namedRoutes [ Contain Named Routes ]
*/ 
private $params = [];
private $regex  = [];
private static $namedRoutes = [];


/**
 * Constructor
 * 
 * @param array $params
 * @return void
*/
public function __construct($params = [])
{
      $this->addParams($params);
}


/**
 * Add Params
 * @param array $params 
 * @return void
*/
public function addParams($params = [])
{
    $this->params = array_merge($this->params, $params);
}


/**
 * Set route params
 * @param string $key 
 * @param string $value 
 * @return void
 */
public function setParam($key, $value)
{
     $this->params[$key] = $value;
}


/**
 * Set route params
 * @param string $key 
 * @return void
*/
public function getParam($key)
{
     return $this->params[$key];
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
 * Add named routes
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
public function replacePattern()
{
    return preg_replace_callback('#:([\w]+)#', 
      [$this, 'paramMatch'], 
      $this->getParam('pattern')
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
    $path = $this->getParam('path');

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
}


}