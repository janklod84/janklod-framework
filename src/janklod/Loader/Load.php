<?php 
namespace JK\Loader;


/**
 * @package JK\Loader\Load
*/ 
class Load
{
      
  /**
   * @var \JK\Container\ContainerInterface
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
     $model = $this->getModel($name);
     $this->{$name} = new $model();
 }  

 /**
  * entity name
  * @param string $entity 
  * @return void
 */
 public function entity($entity)
 {
    $entityName = $this->getModel(sprintf('Entity\\%s', $entity));
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
      $managerName = $this->getModel(sprintf('Manager\\%s', $manager));
      $entity = strtolower($entity);
      $this->{$entity} = new $managerName();
 }

 /**
  * Get model name
  * @param string $name 
  * @return string
 */
 public function getModel($name)
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
             $this->controller = $this->getController($this->app);
             $action = strtolower($callback['action']);
             $callback = [$this->controller , $action];
        }
        
        if(!is_callable($callback))
        {
            die('No callable'); // redirect to 404 page
        }
        
        $this->call($this->controller, 'before');
        call_user_func_array($callback, $this->matches);
        $this->call($this->controller, 'after');
        
 }


/**
 * Call before or after how we want
 * @return void
*/
public function call($object, $method='before')
{
   if(method_exists($object, $method) || $object->{$method} !== false)
   {
      call_user_func($object, $method);
   }

}



/**
* Get controller
* 
* @var mixed $argument
* @return object
* @throws \Exception
*/
private function getController($argument)
{
    $controller = $this->callback['controller'];
    $controllerClass = sprintf('app\\controllers\\%s', $controller);

    if(!class_exists($controllerClass))
    {
         throw new Exception(
           sprintf('class <strong>%s</strong> does not exit!', $controllerClass), 
           404
        );
    }

    return new $controllerClass($argument);
}


}