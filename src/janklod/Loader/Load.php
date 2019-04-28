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
         * Load controller
         * @param string $name 
         * @return object
       */
        public function controller($name)
        {
            $controller = '\\app\\controllers\\'. $name;
            
            if(class_exists($controller))
            {
                return new $controller($this->app);
            }
        }


      /**
       * Load action
       * @param string $name 
       * @return object
      */
      public function model($name) {}
      
}