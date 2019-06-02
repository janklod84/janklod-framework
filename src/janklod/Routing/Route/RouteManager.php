<?php 
namespace JK\Routing\Route;


use JK\Routing\Route\Controls\{
  PathControl,
  CallbackControl,
  OptionControl
};

/**
 * Manager Route
 * @package JK\Routing\Route\RouteManager
*/ 
class RouteManager
{
       
/**
 * @var array  $namedRoutes [ Named Routes ]
*/ 
private $params  = [];
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
 * Add named routes
 * @param string $name 
 * @return void
*/
public function namedRoutes($name)
{
    self::$namedRoutes[$name] = $this;
}

}