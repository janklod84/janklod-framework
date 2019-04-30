<?php 
namespace JK\Routing;


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
  	   public function __construct($route)
  	   {
  	   	     $this->route = $route;
             $this->callback = $route->get('callback');
             $this->matches  = $route->get('matches');
             debug($route->parameters());
  	   }

       
       /**
        * Get route param
        * @param string $key 
        * @return mixed
       */
       public function get($key)
       {
           return $this->route->get($key);
       }

       
       /**
        * Call controller and action
        * @param object $app
        * @return mixed
       */
  	   public function callAction($app)
  	   {
  	   	    try 
  	   	    {
                  if(is_array($this->callback))
                  {
                       $controller = $this->getController();
                  	   $action = $this->getAction();
                       $this->callback = [new $controller($app) , $action];
                  }
                  
                  if(is_callable($this->callback))
                  {
                  	  return call_user_func_array($this->callback, $this->matches);
                  }
                  
  	   	    }catch(\Exception $e){
                    
                   die('Error');
                   exit('Not Found callback');
  	   	    }
  	   }


       /**
        * Get full name of controller
        * Ex: \app\controllers\admin\UserController
        * Ex: \app\controllers\HomeController
        * 
        * @return string
       */
        public function getController()
        {
       	    $controller = sprintf('app\\controllers\\%s', 
                                   $this->callback['controller']
                          );

            if(!class_exists($controller))
            {
                 die(sprintf('class <strong>%s</strong> does not exit!', $controller));
            }

            return $controller;
        }

             
        /**
          * Get full name of action
          * Ex: 'index', 'about' ...
          * @return string
        */
        public function getAction()
        {
      	 	   return mb_strtolower($this->callback['action']);
        }

       
       /**
        * Get route params
        * @return array
       */
       public function getParameters()
       {
            return $this->matches;
       }

}