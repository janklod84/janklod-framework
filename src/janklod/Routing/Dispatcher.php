<?php 
namespace JK\Routing;


use \Exception;

/**
 * @package JK\Routing\Dispatcher 
*/ 
class Dispatcher 
{
       

   /**
    * @var \JK\Routing\RouteHandler $route
    * @var mixed $callback
    * @var array $matches
   */
   private $route;
   private $callback;
   private $matches = [];




   /**
    * Constructor
    * @param  \JK\Routing\RouteHandler $route 
    * @return void
   */
   public function __construct(RouteHandler $route)
   {
   	     $this->route    = $route;
         $this->callback = $route->get('callback');
         $this->matches  = $route->get('matches');
   }

   
   /**
    * Call controller and action
    * @param \JK\Container\ContainerInterface $app
    * @return mixed
   */
   public function callAction($app)
   {
          if(is_array($this->callback))
          {
               $controllerObj = $this->getController($app);
               $action = strtolower($this->callback['action']);
               $this->callback = [$controllerObj , $action];
          }
          
          if(!is_callable($this->callback))
          {
              die('No callable'); // redirect to 404 page
          }

          return call_user_func_array($this->callback, $this->matches);
              
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
          $controller_name = $this->callback['controller'];
     	    $controllerClass = sprintf('app\\controllers\\%s', $controller_name);

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