<?php 
namespace JK\DI;

/*
use JK\DI\Containers\
{
    Registry,
    Singleton,
    RegisterInterface
};
*/
use JK\DI\Containers\Registry;
use JK\DI\Containers\Singleton;
use JK\DI\Containers\RegisterInterface;

/**
 * @package JK\DI\Container
*/ 
class Container implements ContainerInterface
{
         
/**
* @var array $container
* @var self $instance
*/
private $container = [];
private static $instance;


/**
* prevent instance from being cloned
* @return void
*/
private function __clone(){}



/**
* prevent instance from being unserialized
* @return void
*/
private function __wakeup(){}



/**
* Constructor
* @param array $container 
* @return void
*/
private function __construct($container = [])
{
    $this->merge($container);
}


/**
 * Get instance
 * 
 * $app = Container::instance();
 * 
 * 
 * @param array $container 
 * @return self
*/
public static function instance($container = [])
{
     if(is_null(self::$instance))
     {
          self::$instance = new self($container);
     }
     return self::$instance;
}



/**
* Merge data in storage
* Ex:
* $app = Container::instance();
* $app->merge([
*  'name' => 'Name',
*  'item' => Item
*  ...
* ])
* 
* 
* @param array $container 
* @return void
*/
public function merge($container = [])
{
     $this->container = array_merge(
                        $this->container, 
                        $container
                      );
}


/**
 * Add item in storage
 * Ex:
 * $app = Container::instance();
 * $app->set('param1', 'value1');
 * $app->set('kk1', function ($app) {
 *    $app->set('ff', 'dwerr')
 *    ..........
 *    ..........
 * })
 * 
 * @param string $key 
 * @param mixed $resolver 
 * @return void
*/
public function set($key, $resolver)
{
    $this->container[$key] = $resolver;
}


/**
* Set Instance
* 
* Ex:
* $app  = Container::instance();
* $app->setInstance(app\\models\\User);
* $app->setInstance(BlogModule::class);
* $app->setInstance(app\\controller\\BlogController);
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
 * Ex:
 * $app = Container::instance();
 * $app->registry('articles', function () {
 *    return Article::all();
 * })
 * 
 * $app->registry('db', new Database::instance());
 * 
 * @param string $key 
 * @param mixed $value 
 * @return void
*/
public function registry($key, $resolver)
{
    $this->set($key, 
      new Registry($key, $this->resolverMap($resolver))
    );
}



/**
* Add singleton
* Ex:
* $app = Container::instance();
* $app->singleton('db', function () {
*    return new Database::instance();
* })
* 
* $app->singleton('db', new Database::instance());
* 
* 
* @param string $key 
* @param mixed $resolver 
* @return void
*/
public function singleton($key, $resolver)
{
    $this->set($key, 
      new Singleton($key, $this->resolverMap($resolver))
    );
}


/**
* Create new object by given name
* 
* $app->create(app\\models\\User);   => new User()
* $app->create(User::class);         => new User()
* $app->create(User::class, params); => new User($params)
* 
* @param string $classname
* @param mixed $arguments
* @return object
*/
public function create($classname, $arguments = null)
{
    $reflection = new Reflection($classname);
    $reflection->setArguments($arguments);
    return $reflection->createNewObject();
}


/**
* Get item by key from container
* Ex:
* Container::instance()->get('test')
* 
* @param string $key 
* @return mixed
*/
public function get($key)
{
   if($this->has($key))
   {
       if($this->container[$key] instanceof RegisterInterface)
       {
            return $this->container[$key]->get($key);
       }else{
           return $this->call($key);
       }

   }else{
       
       # auto calling object
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
   if($this->has($key))
   {
       unset($this->container[$key]);
   }
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
 * Return all container params
 * @return array
*/
public function all()
{
     return $this->container;
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
* Determine data container
* 
* @param string $key
* @return mixed
*/
private function call($key)
{
  if($this->container[$key] instanceof \Closure)
  {
       return call_user_func($$this->container[$key], $this);
  }

  return $this->container[$key];
}


/**
* Return resolver as closure or not
* @param mixed $parsed 
* @return mixed
*/
protected function resolverMap($resolver)
{
   if($resolver instanceof \Closure)
   {
        return call_user_func($resolver);
   }
   return $resolver;
}


}