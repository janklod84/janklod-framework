<?php 
namespace JK\Routing\Route;

use JK\Routing\Route\Controls\{
	// RegexControl,
	NamedRouteControl
};


/**
 * Route Params
 * @package JK\Routing\Route\RouteParameter
*/ 
class RouteParameter
{

     
/**
 * @var array $params  [ Route Params   ]
 * @var array $namedRoutes
*/ 
private $params = [];
private static $namedRoutes = [];



/**
 * Constructor
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
  * Get Url
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