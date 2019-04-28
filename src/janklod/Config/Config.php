<?php 
namespace JK\Config;


/**
 * @package JK\Config\Config 
*/ 
class Config 
{
         
       /**
        * @var string $configPath  [ configuration directory ]
        * @var array $stored       [ Repository configuation ]
       */
	     protected static $configPath = '';
         protected static $stored = [];


       /**
        * Constructor
        * @param array $stored
        * @return void
       */
	     public function __construct($stored = null)
	     {
	     	   if(is_string($stored) && file_exists($stored))
	     	   {
                $stored = require_once($stored);
	     	   }
           self::push($stored);
	     }

         
       /**
        * Set configuration root directory
        * @param string $path 
        * @return void
       */
       public static function root($path)
       {
       	   self::$configPath = $path;
       }


       /**
        * Config
        * @param string $key 
        * @param mixed $value 
        * @return void
       */
	     public static function set($key, $value)
	     {
           self::$stored[$key] = $value;
	     }


       /**
        * Determine if has key in data stored
        * @param string $key 
        * @return bool
       */
       public static function has($key)
       {
            return isset(self::$stored[$key]);
       }


       /**
        * Push stored data
        * @param array $stored 
        * @return void
       */
       public static function push($stored = [])
       {
       	    self::$stored = array_merge(self::$stored, $stored);
       }

         
      /**
       * Get configuration from file
       * Ex: Config::fromFile('app') [ put group name of file ]
       * 
       * @param string $fileName 
       * @return array
     */
      public static function fromFile($fileName = 'no-file')
      {
           $file = trim(self::$configPath, '/') . '/' . trim($fileName, '/') . '.php';

           if(!file_exists($file))
           {
           	    exit(sprintf('File <strong>%s</strong> does not exist', $file));
           }
           
           $path = realpath($file);
           $data = include($path);
           self::set($fileName, $data);
           return $data;
     }


         
     /**
      * Get all stored configuration
      * @return array
     */
     public static function all()
     {
     	   return self::$stored;
     }


}