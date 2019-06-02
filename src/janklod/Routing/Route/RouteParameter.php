<?php 
namespace JK\Routing\Route;

/**
 * Route Params
 * @package JK\Routing\Route\RouteParameter
*/ 
class RouteParameter
{

     
/**
 * @var array $params      [ Route Params   ]
 * @var array $regex       [ Route patterns ]
 * @var array $namedRoutes [ Named Routes   ]
*/ 
private $params = [];
private $regex  = [];
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
   
   // $this->setParam('regex', $this->regex);
   return $this;
}



}