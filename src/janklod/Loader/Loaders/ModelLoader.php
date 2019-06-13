<?php 
namespace JK\Loader\Loaders;


/**
 * @package JK\Loader\Loaders\ModelLoader
*/ 
class ModelLoader extends CustomLoader
{

/**
 * @var array $models
*/
private $models = [];

/**
* Load model
* 
* @param string $name 
* @return object
*/
public function model($name)
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
private function hasModel($model)
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
   $model = $this->module('\\app\\models', $name);
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