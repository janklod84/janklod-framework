<?php 
namespace JK;


use JK\FileSystem\File;
use JK\DI\ContainerBuilder;


use JK\Config\Config;



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
         * Container Builder 
         * @var \JK\DI\ContainerBuilder $containerBuilder
        */
        private $containerBuilder;



 
        /**
         * Container Dependency Injection Interface
         * @var $app JK\Container\ContainerInterface
        */
        private $app;


        
        /**
         * @var string $root [ root of Application ]
        */
        private $root;




        /**
          * Contructor
          * @param string $root
          * @return void
        */
        private function __construct($root)
        {
             $this->root = $root;
             $this->containerBuilder = new ContainerBuilder();
             $this->app = $this->getContainer();
             $this->bind('file', new File($root));
        }


        /**
          * Break Point of Application
          * @return mixed
        */
        public function run()
        {   
             $dispatcher = $this->router->dispatch($this->request->method());

             debug($dispatcher, false);
             /*
             $controller = $this->load->controller($dispatcher->get('controller'));
             $dispatcher->callAction($this->app);
             */


             # PRINT OUTPUT
             // $this->app->printOut();
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
        * Create new instance and inject automatically
        * Create new object [ex: (new \JK\Application())->make(Blog::class) ]
        * $obj = $this->app->make('JanKlod\\Test', ['id' => 1, 'slug' => 'jean']);
        * $this->make('JanKlod\\Test', [1, jean']);
        * $this->make('JanKlod\\Test');
        * 
        * @param string $name 
        * @return object
       */
       public function make(string $name, $arguments = null): object
       {
             return $this->app->create($name, $arguments);
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
        * Call automatically item from container
        * @param string $key 
        * @return mixed
       */
       public function __get($key)
       {
           return $this->get($key);
       }


       /**
        * Add container you want to use
        * @param string|object $container 
        * @return void
       */
       public function addContainer($container)
       {
             $this->containerBuilder->addContainer($container);
       }


       
       /**
        * Add definition
        * @param string|array $definition 
        * @return $this
       */
       public function addDefinition($definition): self
       {
             $this->containerBuilder->addDefinitions($definition);
             return $this;
       }
      

       /**
        * Get container
        * Dependency Injection Container
        * @return \JK\Container\ContainerInterface
       */
       public function getContainer()
       {
            return $this->containerBuilder->build();
       }

       
       /**
        * Load all alias
        * @param array $alias
        * @return void
       */
       public function loadAlias()
       {
           Initialize::alias();
       }


       /**
        * Load all services providers
        * @return void
       */
       public function loadProviders()
       {
           Initialize::providers($this->app);
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