<?php 
namespace JK\Container;


use \ReflectionClass;

/**
 * Class Manager [ Dependency Injection Container ]
 * @package JK\Container\DI
*/ 
class DI implements ContainerInterface
{

        
        /**
         * @var array $container [ contain all registrations ]
        */
        private $container = [];



        /**
         * Constructor
         * @param array $container 
         * @return void
        */
	    public function __construct($container = [])
	    {
              $this->container = array_merge($this->container, $container);
	    }

        
        /**
         * Add item in container
         * @param string $key 
         * @param type $resolver 
         * @return type
        */
         public function set($key, $resolver)
         {
               $this->container[$key] = $resolver;
         }


        /**
         * Add registry
         * @param string $key 
         * @param mixed $value 
         * @return void
        */
         public function registry($key, $resolver)
         {
             $this->set($key, new RegistryResolver($key, $resolver));
         }


        /**
         * Add singleton
         * @param string $key 
         * @param mixed $resolver 
         * @return void
        */
        public function singleton($key, $resolver)
        {
              $this->set($key, new MultitonResolver($key, $resolver));
        }


       /**
         * Get item by key from container
         * @param string $key 
         * @return mixed
       */
        public function get($key)
        {
               if($this->has($key))
               {
                   if($this->find($key) instanceof ResolverInterface)
                   {
                       return $this->find($key)->resolve($key);

                   }

                   return $this->call($key);
               }
        }


       /**
         * Call shared item directly by key name
         * Exemple : $this->{$key} if isset this key [$this->app->{$key}]
         * 
         * @param string $key 
         * @return mixed
        */
        public function __get($key)
        {
             return $this->get($key);
        }


        
        /**
         * Determine if isset $key in container
         * @param mixed $key 
         * @return bool
         */
        public function has($key): bool
        {
            return isset($this->container[$key]);
        }

        
        /**
         * Find item from container
         * @param mixed $key 
         * @return mixed
        */
        public function find($key)
        {
            return $this->container[$key];
        }

       

        /**
         * Create new object
         * @param type $name 
         * @return type
        */
        public function factory(string $name)
        {
            return $this->createNewObject($name);
        }


        /**
         * Merge data in container
         * @param array $data 
         * @return void
        */
        public function merge(array $data = [])
        {
              $this->container = array_merge($this->container, $data);
        }

        
        /**
         * momentaly output
         * @return void
         */
        public function output()
        {
            debug($this->container);
        }



        /**
         * Determine data container
         * @param string $key
         * @return mixed
        */
        private function call($key)
        {
            $container = $this->find($key);

            if($container instanceof \Closure)
            {
                 return $container($this);
            }
          
            return $container;
        }



       /**
         * Create new object if class exist
         * This method will be extended !
         * 
         * @param string $objName 
             * @param $params constructor params
         * @return object
        */
        private function createNewObject($objName): object
        {
             if(!class_exists($objName))
             {
                exit(sprintf('Class <strong>%s</strong> does\'nt exist', $objName));
             }

             $reflectedClass = new ReflectionClass($objName);
             $instance = $reflectedClass->getName();
             $this->container[$objName] = new $instance; 
             return $this->container[$objName];
        }
}