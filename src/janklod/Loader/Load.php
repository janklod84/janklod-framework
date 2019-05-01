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
      * Load model
      * @param string $name 
      * @return object
     */
     public function model($name)
     {
         $model = sprintf('\\app\\models\\%s', $name);
         $name  = strtolower($name);

         if(class_exists($model))
         {
             $this->{$name} = new $model($this->app);
         }
     }  
}