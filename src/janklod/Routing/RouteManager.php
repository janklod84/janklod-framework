<?php 
namespace JK\Routing;


/**
 * @package JK\Routing 
*/ 
class RouteManager 
{
       
       /**
        * @var \JK\Routing\RouteObject
       */
       private $route;
      
       /**
        * @const array 
       */
       const PREFIX_REQUIRED = ['path', 'controller'];

       /**
        * Constructor
        * @var RouteObject $route
       */
  	   public function __construct(RouteObject $route)
  	   {
              $this->route = $route;
  	   }



      /**
       * Prepare callback
       * @return void
      */
      public function dispatchCallback()
      {
          if($this->route->has('callback') && is_string($this->route->get('callback')))
          {
               if(strpos($this->route->get('callback'), '@') !== false)
               {
                   list($controller, $action) = explode('@', $this->route->get('callback'), 2);
                   $this->route->set('controller', $controller);
                   $this->route->set('action', $action);
               }
          }
     }
     
     
     /**
      * Add named route
      * @return void
     */
     public function fiterRoute()
     {
          if($this->notNamed())
          {
              $this->route->set('name', $this->route->get('callback'));
          }

          if($name = $this->route->get('name'))
          {
          	  $this->route->addNamedRoute($name);
          }
     }



     /**
      * Add differents prefix
      * @return void
     */
     public function addPrefix()
     {
          if($this->route->hasOption('prefix'))
          {
          	   $option = $this->route->getOption('prefix'); 

               foreach(self::PREFIX_REQUIRED as $index)
               {
                    if(isset($option[$index]))
                    {
                         call_user_func([$this, 'full'. ucfirst($index)]);
                    }
               }
          }
     }


     /**
      * Get path with prefix
      * @return string
     */
     private function fullPath()
     {
         $pathPrefix = $this->prefixItem('path');
         $path = trim($pathPrefix, '/') . '/' . $this->route->get('path');
         $this->route->set('path', $path);
     }


     /**
      * Get callback with prefix
      * @return 
     */
     private function fullController()
     {
          $controllerWithPrefix = $this->prefixItem('controller');
          $callback = $controllerWithPrefix . '\\' . $this->route->get('callback');
          $this->route->set('callback', $callback);
     }

     
     /**
      * Get prefix item
      * @param string $key 
      * @return mixed
     */
     private function prefixItem($key)
     {
     	   return $this->route->getOption('prefix')[$key] ?: null;
     }

     
     /**
      * Determine if route not named 
      * @return bool
     */
     private function notNamed()
     {
     	 return is_string($this->route->get('callback')) 
     	        && $this->route->get('name') === null;
     }
}