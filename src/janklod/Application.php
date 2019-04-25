<?php 
namespace JK;


use JK\FileSystem\File;
use JK\Container\DIC;



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
         * @var JK\Container\ContainerInterface
        */
        private $app;


        
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
            $file = $this->make(Test::class);
            
            debug($file);
          
            $this->app->output();
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
              $this->app->registry($key, $resolver);
        }



       /**
        * Make Object Factory
        * Create new object [ex: (new \JK\Application())->make(Blog::class) ]
        * $obj = $this->app->make('JanKlod\\Test');
        * $obj->show()
        * 
        * @param string $name 
        * @return object
       */
       public function make(string $name): object
       {
            return $this->app->factory($name);
       }

       
       /**
        * Set object as singleton
        * @param string $key 
        * @param mixed|callable $resolver 
        * @return void
       */
       public function singleton(string $key, $resolver)
       {
            $this->app->singleton($key, $resolver);
       }

      

       /**
         * get resolver by key 
         * @param string $key 
         * @return mixed
       */
       public function get(string $key)
       {
            return $this->app->get($key);
       }

       
      

      /**
       * Contructor
       * @param string $root
       * @return void
     */
      private function __construct($root)
      {
            $this->root = $root;
            $this->app  = $this->getContainer();
      }


      /**
       * Get container
       * Dependency Injection Container
       * @return \JK\Container\DIC
      */
      private function getContainer()
      {
           return new DIC(['file' => new File($this->root)]);
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