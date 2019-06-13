<?php 
namespace JK\Loader;


use \Exception;
use JK\Loader\Loaders\ActionLoader;



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
private $models = [];



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
* 
* @param  string|\Closure $callback
* @param  array  $matches
* @return mixed
*/
public function callAction($callback, $matches=[])
{
   $loader = new ActionLoader($this->app);
   return $loader->process($callback, $matches);
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