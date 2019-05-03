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
   private $controller;
   private $matches = [];




   /**
    * Constructor
    * @param  \JK\Routing\RouteHandler $route 
    * @return void
   */
   public function __construct($route)
   {
   	     $this->route    = $route;
         $this->callback = $route->get('callback');
         $this->matches  = $route->get('matches');
   }

   
   /**
    * Get route param
    * Ex:
    *   $this->get('path')
    *   $this->get('method')
    *   $this->get('')
    * 
    * @param string $key 
    * @return mixed
   */
   public function get($key)
   {
       return $this->route->get($key);
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
               $controller = $this->getController();
               $this->controller = new $controller($app);
               $this->callback = [$this->controller , $this->getAction()];
          }
          
          if(is_callable($this->callback))
          {
               # to manage callBefore and callAfter
               $this->callBefore();
          	   call_user_func_array($this->callback, $this->matches);
               $this->callAfter();

          }else {
             
             // must to redirect to page 404 later
             die('No callable');
          }
              
   }


   /**
    * Get full name of controller
    * Ex: \app\controllers\admin\UserController
    * Ex: \app\controllers\HomeController
    * 
    * @return string
    * @throws \Exception
   */
    private function getController()
    {
   	    $controller = sprintf('app\\controllers\\%s', $this->callback['controller']);

        if(!class_exists($controller))
        {
             throw new Exception(
               sprintf('class <strong>%s</strong> does not exit!', $controller), 
               404
            );
        }

        return $controller;
    }

         
    /**
      * Get full name of action
      * Ex: 'index', 'about' ...
      * @return string
    */
    private function getAction()
    {
         return mb_strtolower($this->callback['action']);
    }

   
   /**
    * Get matches params of current route
    * @return array
   */
   private function matches()
   {
        return $this->matches;
   }

   
   /**
    * Do some action before callback
    * @return void
   */
   private function callBefore()
   {
        if(method_exists($this->controller, 'before'))
        {
             $this->controller->before();
        }
   }


   /**
    * Do some action before callback
    * @return void
   */
   private function callAfter()
   {
        if(method_exists($this->controller, 'after'))
        {
             $this->controller->after();
        }
   }

}