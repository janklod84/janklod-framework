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
}