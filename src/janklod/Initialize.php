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
 * @param array $aliases
 * @return void
*/
public static function alias($aliases = [])
{
	   self::$aliases =  $aliases ?: self::get('alias');
     
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
 * @param string $parsed
 * @return 
*/
public static function functions(string $parsed=null)
{
    $parsed = $parsed ?: __DIR__.'/Functions/*';
    foreach(glob($parsed) as $functionPath)
    {
           if(is_file($functionPath))
           {
                if(pathinfo($functionPath)['extension'] === 'php')
                {
                     if($path = realpath($functionPath))
                     {
                         array_push(self::$functions, $functionPath);
                         require_once($path);
                     }
                }   
           }
    }

}


public static function d($arr, $die=false)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
  if($die) die;
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