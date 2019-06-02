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
* Call action
* @param \JK\Container\ContainerInterface $app
* @return mixed
*/
public function callAction($callback, $matches=[])
{
     $this->ensureCallback($callback);
     if($callback instanceof \Closure)
     {
          $output = call_user_func($callback, $matches);

     }else{
          // gestion du cas ou callback est array
         $controller = $this->getController(
            $callback['controller']
         );
         $action = strtolower(
            $callback['action']
         );
         $this->call($controller, 'before');
         $output = call_user_func_array([$controller , $action], $matches);
         $this->call($controller, 'after');
         if(method_exists($controller, 'pretty'))
         {
              call_user_func([$controller, 'pretty']);
         }
     }

     // response send headers to server
     $output = (string) $output;
     $this->app->response->setBody($output);
     $this->app->response->send();
}


/**
 * Check callback
 * @param mixed $callback 
 * @return void
*/
public function ensureCallback($callback)
{
    if(!is_callable($callback))
    {
         die('NO CALLABLE');
         notFound();
    }
}


/**
* Call before or after 
* how we want
* @param object $object
* @param string $method
* @return void
*/
public function call($object, $method='before')
{
    if(is_object($object))
    {
        if(method_exists($object, $method))
        {
            call_user_func([$object, $method]);
        }
    }
}


/**
 * Get current object object
 * @param object $obj 
 * @return type
*/
public function currentObjectName(object $obj)
{
    return get_class($obj);
}


/**
 * Get module name
 * @param string $directory 
 * @param string $name 
 * @return string
*/
public function getModule($directory='', $name='')
{
  $directory = rtrim($directory, '\\');
   return sprintf('%s\\%s', $directory, $name);
}


/**
* Get controller
* @param string $name
* @return object
* @throws \Exception
*/
public function getController($name)
{
    $controller = $this->getModule('\\app\\controllers', $name);
    if(!class_exists($controller))
    {
         throw new Exception(
           sprintf('class <strong>%s</strong> does not exit!', $controller), 
           404
        );
    }

    return new $controller($this->app) ?: new \stdClass();
}




/**
* Load module [To add more functionalites later]
* @param string $name
* @return string
* @throws \Exception
*/
public function module(string $name)
{
     return $this->getModule('\\modules', $name);
}



/**
* Call the given model
* 
* @param string $model 
* @return object
*/
public function model($model)
{
    $model = $this->getModelName($model) ?: new \stdClass();
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
   $model = $this->getModule('\\app\\models', $name);
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