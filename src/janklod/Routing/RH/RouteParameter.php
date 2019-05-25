<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteParameter
*/ 
class RouteParameter
{
       
/**
 * @var array  $params [ Route Params ]
*/ 
private $params = [];


/**
 * Constructor
 * @param array $params 
 * @return void
*/
public function __construct($params = [])
{
     $this->add($params);
}


/**
 * Add Params
 * @param array $params 
 * @return void
*/
public function add($params = [])
{
     $this->params = $params;
}


/**
 * Set item of params
 * @param string $key 
 * @param mixed $value 
 * @return void
*/
public function set($key, $value)
{
      $this->params[$key] = $value;
}

/**
 * Determine if isset item
 * @param string $key 
 * @return bool
*/
public function has($key): bool
{
    return isset($this->params[$key]);
}


/**
 * Get item param current route
 * @param string $key 
 * @return mixed
*/
public function get($key = null)
{
    return $this->has($key) ? $this->params[$key] : null;
}


/**
 * Get all params curren route
 * @return array
*/
public function parameters()
{
     return $this->params ?? [];
}


}