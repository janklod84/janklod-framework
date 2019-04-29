<?php 
namespace JK\DI;



/**
 * @package JK\DI\Container
*/ 
class Container implements ContainerInterface
{
         
     /**
      * @var array $container
     */
     private $container = [];


     /**
      * Constructor
      * @param array $container 
      * @return void
     */
     public function __construct($container = [])
     {
          $this->merge($container);
     }

     
     /**
      * Merge data in storage
      * @param array $container 
      * @return void
     */
     public function merge($container = [])
     {
           $this->container = array_merge($this->container, $container);
     }


     /**
       * Add item in storage
       * @param string $key 
       * @param mixed $resolver 
       * @return void
     */
     public function set($key, $resolver)
     {
          $this->container[$key] = $resolver;
     }

     
     /**
      * 
      * @param mixed $instance 
      * @return type
     */
     public function setInstance($instance)
     {
     	    $name = (new Reflection($instance))->name();
          $this->set($name, $instance);
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
          $this->set($key, new SingletonResolver($key, $resolver));
     }

     
     /**
      * Create new object by given name
      * @param string $className
      * @param mixed $arguments
      * @return object
     */
     public function create($className, $arguments = null)
     {
          $reflection = new Reflection($className);
          $reflection->setArguments($arguments);
          return $reflection->createNewObject();
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
               if($this->retrieve($key) instanceof ResolverInterface)
               {
                    return $this->retrieve($key)->resolve($key);

               }else{

                   return $this->call($key);
               }

           }else{
               
               # autowiring
               $reflection = new Reflection($key);
               $constructorParams = $this->populateParams($reflection->parameters());
               $reflection->setArguments($constructorParams);
               return $reflection->createNewObject();
           }
     }


     
     

   /**
     * Determine if has $key in container
     * @param string $key 
     * @return bool
   */
   public function has($key): bool
   {
        return isset($this->container[$key]);
   }


   /**
    * Remove item from container
    * @param string $key 
    * @return void
   */
   public function remove($key)
   {
   	   unset($this->container[$key]);
   }


   /**
    * Call dynamically object from container
    * @param string $key 
    * @return object
   */
   public function __get($key)
   {
        return $this->get($key);
   }

   

   /**
      * Populate / Filter constructor params
      * @param array $parameters 
      * @return array
   */
    private function populateParams($parameters = [])
    {
          $constructorParams = [];

          foreach($parameters as $parameter)
          {
                if($class = $parameter->getClass())
                {
                    $constructorParams[] = $this->get($class->getName());

                }else{

                    $constructorParams[] = $parameter->getDefaultValue();
                }
          }

          return $constructorParams;
               
    }


   /**
     * Retrieve item from container
     * @param mixed $key 
     * @return mixed
    */
    private function retrieve($key)
    {
        return $this->container[$key];
    }



    /**
      * Determine data container
      * @param string $key
      * @return mixed
    */
    private function call($key)
    {
        if($this->retrieve($key) instanceof \Closure)
        {
             return call_user_func($this->retrieve($key), $this);
        }
      
        return $this->retrieve($key);
    }


    /**
      * print out container
      * @return void
    */
    public function printOut()
    {
        echo '<h3>Container</h3>';
        debug($this->container, false);
    }


}