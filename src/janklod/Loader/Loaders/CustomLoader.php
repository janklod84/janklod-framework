<?php 
namespace JK\Loader\Loaders;


/**
 * @package JK\Loader\Loaders\CustomLoader 
*/ 
abstract class CustomLoader 
{

/**
 * @var JK\Container\ContainerInterface $app
*/
protected $app;

/**
 * Constructor
 * 
 * @param JK\Container\ContainerInterface $app 
 * @return void
*/
public function __construct($app)
{
     $this->app = $app;
}



/**
* Callback
* 
* @param callable $callback
* @param array $params
* @return void
*/
protected function call(callable $callback, $params=[])
{
   call_user_func($callback, $params);
}



/**
 * Get module name
 * 
 * @param string $directory 
 * @param string $name 
 * @return string
*/
protected function module($directory='', $name='')
{
   $directory = rtrim($directory, '\\');
   return sprintf('%s\\%s', $directory, $name);
}


/**
 * Make sure class exist
 * 
 * @param string $class_name 
 * @return void
*/
protected function validate_class($class_name)
{
  if(!class_exists($class_name))
  {
     throw new \Exception(
       sprintf('class <strong>%s</strong> does not exit!', $class_name), 
       404
    );
  }
}

/**
 * Make sure has valid callback
 * 
 * @param  callback $callback 
 * @param  string $message 
 * @return void
*/
protected function validate_callable($callback, $message='No callable')
{
   if(!is_callable($callback))
   {
      throw new \Exception($message);
   }
}

}