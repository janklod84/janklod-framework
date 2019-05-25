<?php 
namespace JK;


/**
 * @package JK\Initialize
**/ 
class Initialize
{
        
/**
 * @var array $alias     [ Container all alias ]
 * @var array $providers [ Container all providers ]
 * @var array $functions [ Container all functions ]
*/
private static $aliases   = [];
private static $providers = [];
private static $functions = [];


/**
 * Initialize all alias
 * @return void
*/
public static function alias()
{
	 self::$aliases =  self::get('alias');
     
     foreach(self::$aliases as $alias => $class_name)
     {
         if(class_exists($class_name))
         {
              class_alias($class_name, $alias);
         }
     }
}


/**
 * Initialize all providers
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public static function providers($app)
{
	 self::$providers = self::get('providers');
     
     foreach(self::$providers as $service)
     {
       if(!class_exists($service))
       {
            exit(sprintf(
                'class Provider <strong>%s</strong> does not exist!', 
                $service)
            );
       }

       $provider = new $service($app);
       call_user_func([$provider, 'register']);
     }
}


/**
 * Load all functions
 * @return 
*/
public static function functions($functions=[])
{
    self::$functions = array_merge(Definition::CONFIG['functions'], self::$functions);
    foreach(self::$functions as $function)
    {
          $functionPath = $function;
          if(!is_file($function))
          {
              $functionPath = realpath(
                __DIR__.'/Functions/' . mb_strtolower($function) . '.php'
              );
          }
          if(!$functionPath)
          {
              exit(
                sprintf('Function file <strong>%s</strong> does not exist!',
                $functionPath)
              );
          }
          require_once($functionPath);
    }
}



/**
 * Merge data
 * @param string $key 
 * @return array
*/
private static function get($key)
{
     $config = \JK\Config\Config::get('app.'.$key) ?: []; 
	   return array_merge(Definition::CONFIG[$key], $config);
}
}