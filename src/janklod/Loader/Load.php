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
* @param  JK\Routing\Dispatcher $dispatcher
* @return mixed
*/
public function callAction($dispatcher)
{
   $loader = new ActionLoader($this->app);

   // Get callback and matches params
   $callback = $dispatcher->callback();
   $matches  = $dispatcher->matches();
   
   // Call process
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