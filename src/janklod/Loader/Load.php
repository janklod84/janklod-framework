<?php 
namespace JK\Loader;


use \Exception;
use JK\Loader\Loaders\{
 ActionLoader,
 ModelLoader
};



/**
 * @package JK\Loader\Load
*/ 
class Load
{
      
/**
* @var ContainerInterface $app
*/
private $app;


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
    $loader = new ModelLoader($this->app);
    return $loader->model($model);
}  

}