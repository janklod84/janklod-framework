<?php 
namespace JK\Loader;


use \Exception;
use \Config;
use JK\Debug\Debogger;


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
      $output = null;

      if(is_string($callback) && strpos($callback, '@') !== false) 
      {
          list($controller, $action) = explode('@', $callback, 2);

          $controllerObj = $this->controller($controller);
          $action = strtolower($action);
          
          $this->app->set('current.controller', get_class($controllerObj));
          $this->app->set('current.action', $action);

          $this->call($controllerObj, 'before');
          $output = call_user_func_array([$controllerObj , $action], $matches);
          $this->call($controllerObj, 'after');
          
          // show message
          $this->notify();

     }else{
         
        if($callback instanceof \Closure)
        {
            $output = call_user_func($callback, $matches);
        }
     }
     return $output;
}


/**
 * Show messages
 * 
 * @return void
*/
public function notify()
{
   $debogger = new Debogger($this->app);
   $debogger->output(\Config::get('app.debug'));
}


/**
* Call before or after 
* 
* @param object $object
* @param string $method
* @return void
*/
public function call($object, $method='before')
{
    if(method_exists($object, $method))
    {
        call_user_func([$object, $method]);
    }
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
public function controller($name)
{
    $controller = $this->getModule('\\app\\controllers', $name);
    if(!class_exists($controller))
    {
         throw new LoadException(
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