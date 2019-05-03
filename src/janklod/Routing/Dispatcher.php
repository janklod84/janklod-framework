<?php 
namespace JK\Routing;


use \Exception;
use JK\Template\View;

/**
 * @package JK\Routing\Dispatcher 
*/ 
class Dispatcher 
{
       

   /**
    * @var \JK\Routing\RouteHandler $route
    * @var mixed $callback
    * @var string $controller
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
               $controller = $this->controller_name();
               $this->controller = new $controller($app);
               $this->callback = [$this->controller , $this->action_name()];
          }
          
          if(is_callable($this->callback))
          {
          	   call_user_func_array($this->callback, $this->matches);

          }else{
             
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
    private function controller_name()
    {
          $cName = $this->callback['controller'];
     	    $controller = sprintf('app\\controllers\\%s', $cName);

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
    private function action_name()
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
}