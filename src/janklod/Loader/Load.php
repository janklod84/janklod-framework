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
  * Load model
  * @param string $name 
  * @return void
 */
 public function model($name)
 {
     $model = $this->model_name($name);
     $this->{$name} = new $model($this->app);
 }  

 /**
  * entity name
  * @param string $entity 
  * @return void
 */
 public function entity($entity)
 {
    $entityName = $this->model_name(sprintf('Entity\\%s', $entity));
    $entity = strtolower($entity);
    $this->{$entity} = new $entityName();
 }


 /**
  * manager name
  * @param string $manager 
  * @return object
 */
 public function manager($manager)
 {
      $managerName = $this->model_name(sprintf('Manager\\%s', $manager));
      $entity = strtolower($entity);
      $this->{$entity} = new $managerName();
 }

 /**
  * Get model name
  * @param string $name 
  * @return string
 */
 public function model_name($name)
 {
     $model = sprintf('\\app\\models\\%s', $name);
     if(!class_exists($model))
     {
         exit(sprintf('Sorry class <b>%s</b> does not exist!'. $model)); 
     }
     return $model;
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
             $controller = $this->getController($callback['controller']);
             $action = strtolower($callback['action']);
             $callback = [$controller , $action];
             $this->controller = $controller;
        }
        
        if(!is_callable($callback))
        {
            die('No callable'); // redirect to 404 page
        }
        
        $this->call($this->controller, 'before');
        $output = call_user_func_array($callback, $matches);
        $this->call($this->controller, 'after');
        
        // response
        if(is_string($output))
        {
            response()->setBody($output);
        }

        // send headers to server
        response()->send();
 }


/**
 * Call before or after how we want
 * @return void
*/
public function call($object, $method='before')
{
   if(method_exists($object, $method))
   {
      call_user_func($object, $method);
   }

}



/**
* Get controller
* @param string $name
* @return object
* @throws \Exception
*/
private function getController(string $name)
{
    $controllerClass = sprintf('app\\controllers\\%s', $name);
    
    // add here fonctionalites for loading Module classes

    // ...
    if(!class_exists($controllerClass))
    {
         throw new Exception(
           sprintf('class <strong>%s</strong> does not exit!', $controllerClass), 
           404
        );
    }
   
    return new $controllerClass($this->app);
}


}