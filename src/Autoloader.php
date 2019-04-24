<?php 
namespace JK;


/**
 * Autoloader PSR
 * This classe load only classe with namespace
 * How to use it ?
 * You must to create file autoloader.json
 * Inside this file write namespaces you want to map like it:
 * {
      "psr": {
        "NamespaceOne\\": "path/to/one",
        "NamespaceTwo\\": "path/to/two"
      }
  }
 *
 * key [psr is allowed key, you must absolutly write it]
 * May write \JK\Autoloader::instance(__YOUR_ROOT__)->register();
 * @package JK\Autoloader 
*/ 
class Autoloader
{
       
       /**
        * separator for windows / lunix ..
        * @const string
       */
       const DS = DIRECTORY_SEPARATOR;
       

       /**
        * container messages
       */
       const MSG = [
          'no_file' => [
                'Autoloader can not charge file <strong>%s</strong>',
                'May be you must to create file [autoload.json]'
              ]
       ];


       /**
         * @var Autoloader $instance  [ Instance of Autoloader ]
         * @var string     $root      [ root ]
         * @var array      $psr       [ container assignement namespace and root ]
         * @var string     $file      [ file contained autoloading references ]
       */
       private static $instance;
       private $root;
       private $psr = [];
       private $file;


       
      /**
        * prevent instance from being cloned
      */
      private function __clone(){}

   

      /**
       * prevent instance from being unserialized
      */
      private function __wakeup(){}



       /**
         * Get instance of Autoloader
         * @param string $root [ it's root directory for autoloading ]
         * @return self
       */
       public static function instance($root = null): self
       {
              if(is_null(self::$instance))
              {
              	  self::$instance = new self($root);
              }

              return self::$instance;
       }
       


       /**
         * Constructor
         * @param string $root
         * @return void
       */
       private function __construct($root)
       {
            // make sure that param $root is not null 
       	    if(!is_dir($root)) { exit('Not found directory for autoloding ...'); }
            
            $this->root = trim($root, '/');

            // make sure that has file
            $file = $this->root . '/autoloader.json';
            
            if(!file_exists($file))
            {
            	 exit(sprintf($this->getMsg('no_file'), $file));
            }

            $this->file = $file;

            // append psr data
            $this->pushPsr($this->loadContent());
       }


       
       /**
        * Assignement namespace and $root
        * Ex : Autoloader::instance(__DIR__)->addPsr('Test\\', '/path/to/')
        * @param string $namespace [ namespace ]
        * @param string $path      [ path directory ]
        * @return void
       */
       public function addPsr($namespace, $path)
       {
       	     $this->psr[$namespace] = $path;
       	     return $this;
       }

       
       /**
        * Push data to autoload in psr
        * Ex: Autoloader::instance(__DIR__)->pushPsr([
        *   'Test\\' => '/path/to/1',
        *   'App\\'  => '/path/to/2'
        * ])
        * @param array $data 
        * @return void
       */
       public function pushPsr($data = [])
       {
           $this->psr = array_merge($this->psr, $data);
       }

       
       /**
        * Register classes
        * Ex: \JK\Autoloader::instance(__YOUR_ROOT__)->register();
        * @return void
       */
       public function register()
       {
           spl_autoload_register([$this, 'load']);
       }


       /**
        * Load class
        * @param string $className
        * @return bool
       */
       private function load($className)
       {
       	    if($path = $this->classPath($className))
       	    {
       	   	      require_once($path);
       	    }
       }
        

       
       /**
        * Get class path
        * @param type $className 
        * @return type
       */
       private function classPath($className)
       {
       	   $classPath = sprintf('%s.php', $className);

       	   if(!empty($this->psr))
       	   {
               foreach($this->psr as $ns => $path)
               {
               	   $ns_pattern = sprintf('/^%s\/', $ns);

               	   if(preg_match($ns_pattern, $className))
               	   {
                       $classPath = preg_replace(
                       	            $ns_pattern, 
                       	            $this->fullPath($path), 
                       	            $classPath
                       	          );
                       break;

                   }
               }
       	   }

           return realpath($classPath);
       }


       /**
         * Get full path
         * @param string $path 
         * @return string
       */
       private function fullPath($path)
       {
            return $this->root . '/'. trim($path, '/') . '/';
       }


       /**
        * 
        * @return array
       */
       private function loadContent()
       {
           $data = json_decode(file_get_contents($this->file), true);
           return isset($data['psr']) ? $data['psr'] : [];
       }

       
       /**
        * Get message
        * @param string $key 
        * @return string
       */
       private function getMsg($key)
       {
           $msg = self::MSG[$key];
           return is_array($msg) ? implode('. ', $msg) : $msg;
       }

}

