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
	if(is_string($callback) && strpos($callback, '@') !== false) 
	{

	  // Generate valid callback from string parsed
	  list($controller, $action) = explode('@', $callback, 2);
	  $controller_object = $this->controller($controller);
      $action = strtolower($action);

	  $callback = [$controller_object, $action];
	  $this->validate_callable($callback, 
	  '<b>Sorry, Can not call this route. 
	   May be current route already used</b>'
	  );
	 
	  $this->call([$controller_object, 'before']);
	  $this->output = call_user_func($callback, $matches);
	  $this->call([$controller_object, 'after']);
	  
	  // registration current route and current action in container
	   $this->app->add([
	    'current.controller' => get_class($controller_object),
	    'current.action'     => $action
	  ]);
	  
	}else if($callback instanceof \Closure) {
	  $this->output = call_user_func($callback, $matches);
	}
	return $this->output;
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