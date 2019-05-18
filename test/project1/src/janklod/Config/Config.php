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
        * Set configuration root directory
        * @param string $path 
        * @return void
       */
       public static function root($path = null)
       {
       	    self::$configPath = $path;
       }


       /**
        * Push stored data
        * @param mixed $parsed
        * @return void
       */
       public static function store($parsed = null)
       {
            if(is_string($parsed) && file_exists($parsed))
            {
                $stored = require_once($parsed);
            }
            $stored = (array) $parsed;
            self::$stored = array_merge(self::$stored, $stored);
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
        * Get item from stored data
        * @param string $key 
        * @return mixed
       */
       public function item($key)
       {
           return self::has($key) ? self::$stored[$key] : null;
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
        * Find config item
        *  Config::get('test.host')
        *  Config::get('database.host')
        * 
        * @param string $path 
        * @return mixed
       */
       public static function get($path)
       {
             if($path)
             {
                 $path = explode('.', $path);
                 $key  = $path[0] ?? '';
                 $next = $path[1] ?? '';
                 
                 if($config = self::fromFile($key))
                 {
                     $config = !empty($config[$next]) ? $config[$next] : null;

                 }elseif(array_key_exists($key, self::$stored)){

                      $config = self::item($key);

                      foreach($path as $item)
                      {
                          if(isset($config[$item]))
                          {
                              $config = $config[$item];
                          }
                     }
                 }

                 return $config;
             }
             return false;
       }


         
     /**
      * Get all stored configuration
      * @return array
     */
     public static function all()
     {
     	   return self::$stored;
     }

     
	 /**
       * Get configuration from file
       * Ex: Config::fromFile('app') [ put group name of file ]
       * 
       * @param string $fileName 
       * @return array
     */
      public static function fromFile($fileName = null)
      {
           $file = self::filePath($fileName);
           $path = realpath($file);
           $data = include($path);
           return (array) $data;
     }
	 
	 
	 
     /**
      * Get full path config
      * @param string $fileName 
      * @return string
     */
     private static function filePath($fileName)
     {
          if(is_null($fileName)) { return false; }
          self::$configPath = self::$configPath ?: ROOT.'app/config';
          $file = trim(self::$configPath, '/') . '/' . trim($fileName, '/') . '.php';
          if(!file_exists($file))
          {
                exit(sprintf('File <strong>%s</strong> does not exist', $file));
          }
          return $file;
     }


}