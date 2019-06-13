<?php 
namespace JK\Loader\Loaders;


use \Exception;


/**
 * @package JK\Loader\Loaders\ActionLoader
*/ 
class ActionLoader extends CustomLoader
{

/**
 * @var mixed $output 
*/   
private $output;


/**
* Processing callback
* 
* @param mixed $callback 
* @param array $matches 
* @return mixed
*/
public function process($callback, $matches)
{
if($this->is_string_callback($callback)) 
{

  // Generate valid callback from string parsed
  list($controller, $action) = explode('@', $callback, 2);

  // Get controller object and action
  $controller_object = $this->controller($controller);
  $action = strtolower($action);

  $callback = [$controller_object, $action];
  $this->validate_callable($callback, 
  '<b>Sorry, Can not call this route. 
   May be current route already used</b>'
  );
 
  $this->call([$controller_object, 'before']);
  $this->output = $this->call($callback, $matches);
  $this->call([$controller_object, 'after']);
  
  // registration current route and current action in container
   $this->app->add([
    'current.controller' => get_class($controller_object),
    'current.action'     => $action
  ]);
  
}else if($callback instanceof \Closure) {
  $this->output = $this->call($callback, $matches);
}
return $this->output;
}


/**
 * Determine if callback is string
 * 
 * @param mixed $callback 
 * @return bool
*/
private function is_string_callback($callback)
{
  return is_string($callback) 
         && strpos($callback, '@') !== false;
}

/**
* Get controller name
* 
* @param string $name
* @return object
* @throws \Exception
*/
private function controller($name)
{
    $controller = $this->module('\\app\\controllers', $name);
    $this->validate_class($controller);
    return new $controller($this->app) ?: new \stdClass();
}

}