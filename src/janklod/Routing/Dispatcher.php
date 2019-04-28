<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Dispatcher 
*/ 
class Dispatcher 
{
       
       /**
        * @var \JK\Routing\RouteObject
       */
       private $route;

       
       /**
        * @var callback
       */
       private $callback;


       /**
        * Constructor
        * @param  RouteInterface $route 
        * @return RouteInterface
       */
	   public function __construct($route)
	   {
	   	     $this->route = $route;
	   	     $this->callback = $this->get('callback');
	   }

       
       /**
        * Call controller and action
        * @param ContainerInterface $app
        * @return void
       */
	   public function callAction($app)
	   {
	   	    try
	   	    {
	   	    	if($this->route->get('callback') instanceof \Closure)
		   	    {
		   	    	 $callback = $this->route->get('callback');

		   	    }else{

		   	    	 $callback = [$controller, $this->get('action')];
		   	    }
            
                call_user_func($callback, $this->route->matches);

	   	    }catch(\Exception $e) {

	   	    	 exit('Not Found callback ' . __CLASS__);
	   	    }
	   }

       
       /**
        * Get current route param
        * @return mixed
       */
	   public function get($key)
	   {
	   	    return $this->route->get($key);
	   }

}