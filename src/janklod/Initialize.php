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
private static $initialised = [];



/**
 * Initialize all alias
 * @param array $aliases
 * @return void
*/
public static function alias($aliases = [])
{
self::$aliases =  $aliases ?: self::get('alias');

foreach(self::$aliases as $alias => $classname)
{
   if(class_exists($classname))
   {
        if(class_alias($classname, $alias))
        {
            self::$initialised['alias'][] = compact('classname', 'alias');
        }
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
   if(call_user_func([$provider, 'register']) !== false)
   {
       self::$initialised['providers'][] = $service;
   }
 }
}


/**
 * Load all functions
 * @return 
*/
public static function functions()
{
    $maskPath  = __DIR__.'/Functions/*';
    foreach(glob($maskPath) as $functionPath)
    {
           if(is_file($functionPath))
           {
                if(pathinfo($functionPath)['extension'] === 'php')
                {
                     if($path = realpath($functionPath))
                     {
                         if(require_once($path))
                         {
                             self::$initialised['functions'][] = $path;
                         }
                     }
                }   
           }
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


/**
 * Get output all container initialised
 * @return void
*/
public static function output()
{
    echo '<pre>';
    print_r(self::$initialised);
    echo '</pre>';
}


}