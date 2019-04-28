<?php 
namespace JK;


use \JK\Config\Config;


/**
 * @package JK\Initialize
**/ 
class Initialize 
{
        
        /**
         * @var array $alias   [ Container all alias ]
         * @var array $providers [ Container all providers ]
        */
        private static $aliases  = [];
	    private static $providers = [];

        
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
         * @param \JK\Container\ContainerInterface $container
         * @return void
        */
	    public static function providers($container)
	    {
	    	 self::$providers = self::get('providers');
             
	         foreach(self::$providers as $service)
	         {
	               if(!class_exists($service))
                   {
                        exit(sprintf('class <strong>%s</strong> does not exist!', $service));
                   }

                   $provider = new $service($container);
                   call_user_func([$provider, 'register']);
	         }
	    }

        
        /**
         * Merge data
         * @param string $key 
         * @return array
         */
	    private static function get($key)
	    {
	    	 $config = Config::fromFile('app')[$key] ?: []; 
	    	 return array_merge(Definition::CONFIG[$key], $config);
	    }
}