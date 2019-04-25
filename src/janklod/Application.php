<?php 
namespace JK;


use JK\FileSystem\File;
use JK\Container\{
    ContainerBuilder,
    DI 
};


/**
 * Application
 * @package JK\Application
*/ 
final class Application 
{

         
        /**
         * Instance of Application
         * @var JK\Application
        */
        private static $instance;



        /**
         * Container Dependency Injection
         * @var $container JK\Container\DI
        */
        private $container;


        
        /**
         * @var string $root [ root of Application ]
        */
        private $root;



        /**
          * Break Point of Application
          * @return mixed
        */
        public function run()
        {   
            $this->container->output();
        }



        /**
         * Get one times instance of Application
         * Using pattern Singleton
         * @param  string $root
         * @return JK\Application [ instance of application ]
       */
        public static function instance($root = null): self
        {
              if(is_null(self::$instance))
              {
                  self::$instance = new self($root);
              }

              return self::$instance;
        }



        /**
        * Bind key and value in DIC [Dependency Injection Container]
        * @param string $key 
        * @param type $resolver 
        * @return void
        */
        public function bind(string $key, $resolver)
        {
              $this->container->registry($key, $resolver);
        }



       /**
        * Make Object Factory
        * Create new object [ex: (new \JK\Application())->make(Blog::class) ]
        * $obj = $this->container->make('JanKlod\\Test');
        * $obj->show()
        * 
        * @param string $name 
        * @return object
       */
       public function make(string $name): object
       {
            return $this->container->factory($name);
       }

       
       /**
        * Set object as singleton
        * @param string $key 
        * @param mixed|callable $resolver 
        * @return void
       */
       public function singleton(string $key, $resolver)
       {
            $this->container->singleton($key, $resolver);
       }

      

       /**
         * get resolver by key 
         * @param string $key 
         * @return mixed
       */
       public function get(string $key)
       {
            return $this->container->get($key);
       }

       
      

       /**
        * Contructor
        * @param string $root
        * @return void
       */
       private function __construct($root)
       {
            $this->root = $root;
            $this->container  = $this->getContainer();
       }


      /**
       * Get container
       * Dependency Injection Container
       * @param string $name [ Name of container ]
       * @return \JK\Container\DI
      */
       public function getContainer()
       {
           return (new ContainerBuilder(new DI([
               'file' => new File($this->root)
           ])))->create();
      
       }


       /**
        * prevent instance from being cloned
       */
       private function __clone(){}



      /**
       * prevent instance from being unserialized
      */
      private function __wakeup(){}


}