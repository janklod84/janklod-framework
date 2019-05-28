<?php 
namespace JK\Loader;


use \Exception;


/**
 * @package JK\Loader\Load
*/ 
class Load
{
      
/**
* @var \JK\Container\ContainerInterface $app
* @var  
*/
private $app;
private $controller;
private $models = [];
private $controllers = [];
private $callback;



/**
* Constructor
* @param \JK\Container\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
* Call controller and action
* @param \JK\Container\ContainerInterface $app
* @return mixed
*/
public function callAction($callback, $matches=[])
{
    if(is_array($callback))
    {
         $controller = $this->getController(
            $callback['controller']
         );
         $action = strtolower(
            $callback['action']
         );

         $callback = [$controller , $action];
         $this->controller = $controller;
    }
    
    if(!is_callable($callback))
    {
        // redirect to 404 page
        die('No callable'); 
    }
    
    $this->call($this->controller, 'before');
    $output = call_user_func_array($callback, $matches);
    $this->call($this->controller, 'after');
    
    // response send headers to server
    $output  = (string) $output;
    response()->setBody($output);
    response()->send();
}


/**
* Call before or after 
* how we want
* @return void
*/
public function call($object, $method='before')
{
    if(!is_null($object))
    {
        if(!method_exists($object, $method))
        {
            exit('Can not call method .'. $method);
        }
        call_user_func([$object, $method]);
    }
}



/**
* Get controller
* @param string $name
* @return object
* @throws \Exception
*/
public function getController($name)
{
    $controllerClass = sprintf('app\\controllers\\%s', $name);
    if(!class_exists($controllerClass))
    {
         throw new Exception(
           sprintf('class <strong>%s</strong> does not exit!', $controllerClass), 
           404
        );
    }

    return new $controllerClass($this->app);
}


/**
* Load module [To add more functionalites later]
* @param string $name
* @return string
* @throws \Exception
*/
public function module(string $name)
{
     return sprintf('modules\\%s', $name);
}


/**
* Call the given model
* 
* @param string $model 
* @return object
*/
public function model($model)
{
    $model = $this->getModelName($model); 
    if(!$this->hasModel($model))
    {
        $this->addModel($model);
    }
    return $this->getModel($model); 
}  


/**
* Determine if the given 
* class exists in the models container
* 
* @param string $model
* @return bool
*/
public function hasModel($model)
{
     return array_key_exists($model, $this->models);
}


/**
 * Create new object for the given controller and store it
 * in models container
 *
 * @param string $model
 * @return void
*/
private function addModel($model)
{
   $object = new $model($this->app);
   $this->models[$model] = $object;
}



/**
* Get the model  object
*
* @param string $model
* @return object
*/
private function getModel($model)
{
    return $this->models[$model];
}


/**
* Get the full class name for the given model
*
* @param  string $name
* @return string
*/
private function getModelName($name)
{
   $model = sprintf('\\app\\models\\%s', $name);
   if(!class_exists($model))
   {
       exit(sprintf(
        'Sorry class Model [ <b>%s</b> ] does not exist!', 
        $model)
       ); 
   }
   return $model;
}


}