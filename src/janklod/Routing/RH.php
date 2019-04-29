<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteHandler
*/ 
class RouteHandler
{
       
       /**
        * @var string $path        [ Route path ]
        * @var mixed  $callback    [ Route callback ]
        * @var string $name        [ Route name ]
        * @var string $method      [ Route request method ]
        * @var array  $params      [ Route params ]
        * @var string $notFound    [ Route not found ]
        * @var array  $options     [ Contain options ]
        * @var array  $namedRoutes [ Contain named routes ]
        * @var \JK\Routing\RouteManager $routeManager 
       */
       private $path;
       private $callback;
       private $name;
       private $method;
	     private $params  = [];
       private static $notFound;
       private static $options = [];
       private static $namedRoutes = [];
       public $matches = [];


       /**
        * @const array 
       */
       const KEY_PREFIX = ['path', 'controller'];


       /**
        * Constructor
        * @param array $params 
        * @return void
       */
  	   public function __construct($path, $callback, $name, $method = 'GET')
  	   {
              $this->setPath($path);
              $this->setCallback($callback);
              $this->setName($name); 
              $this->setMethod($method);   
  	   }


       /**
        * Set route path
        * @param string $path 
        * @return void
       */
       public function setPath($path)
       {
            $this->path = trim($path, '/');
       }

       /**
        * Get route path
        * @return string
       */
       public function getPath()
       {
            return $this->path;
       }
       
       /**
        * Set callback
        * @param mixed $callback 
        * @return void
      */
       public function setCallback($callback)
       {
             $this->callback = $callback;
       }


       /**
        * Get calback
        * @return mixed
       */
       public function getCallback()
       {
            return $this->callback;
       }
       
       /**
        * Set route name
        * @param string $name
        * @return void
      */
       public function setName($name)
       {
            $this->name = $name;
       }


       /**
        * Get route name
        * @return string
       */
       public function getName()
       {
            return $this->name;
       }


       
       /**
        * Set Method
        * @param string $method [Request method]
        * @return void
      */
       public function setMethod($method)
       {
            $this->method = $method;
       }


       /**
        * Get string
        * @return 
       */
       public function getMethod()
       {
            return $this->method;
       }


      /**
        * add not found
        * @param string $path 
        * @return void
      */
      public static function notFound($path)
      {
             self::$notFound = $path;
      }

          
      /**
       * Get not found page
       * @return string
      */
      public static function getNotFound()
      {
           return self::$notFound;
      }


       /**
        * Add name of route
        * @param string $name 
        * @return void
       */
       public function addNamedRoute($name)
       {
           self::$namedRoutes[$name] = $this;
       }

      

       /**
        * Add one option
        * @param string $key
        * @param mixed $value 
        * @return void
       */
       public static function addOptions($options)
       {
            self::$options = $options;
       }


       /**
        * Get option
        * @return array
       */
       public function getOption($key = null)
       {
           return $this->hasOption($key) ? self::$options[$key] : null;
       }


       
       /**
        * Do something before storage
        * @return void
       */
       public function beforeStore()
       {
           $this->filterRoute();
           $this->addPrefix();
           $this->manageCallback();
       }

       
       /**
        * Do something after storage
        * @return void
       */
       public function afterStore(){}

       

       /**
        * Determine if parsed url match current route
        * @param string $url 
        * @return bool
      */
       public function match($url)
       {
             $url   = trim($url, '/');
             $path  = $this->replacePattern();
             $regex = "#^$path$#i";

             if(!preg_match($regex, $url, $matches))
             {
                  return false;
             }
            
             array_shift($matches);
             $this->matches = $matches;
             return true;
       }


       /**
        * Get matches params
        * @return array
        */
       public function getMatches()
       {
           return $this->matches;
       }


      /**
        * Add regex
        * 
        * $this->with('id', '[0-9]+')->with('slug', '([a-z\-]+)')
        * $this->with(['id' => '[0-9]+', 'slug' => '[a-z\-]+'])
        * 
        * @param mixed $param 
        * @param string $regex 
        * @return $this
      */
       public function with($param, $regex = null)
       {
             if(!is_null($regex))
             {
                  $this->params[$param] = str_replace('(', '(?:', $regex); 
             }

             if(is_array($param) && is_null($regex))
             {
                  foreach($param as $index => $exp)
                  {
                       $this->params[$index] = str_replace('(', '(?:', $exp); 
                  }
             }

             return $this;
       }


       /**
         * Get Url
         * @param type $name 
         * @param type|array $params 
         * @return type
       */
        public static function url($name, $params = [])
        {
             if(!isset(self::$namedRoutes[$name]))
             {
                   return \JK\Helper\Url::to($name, $params);
             }

             return self::$namedRoutes[$name]->getUrl($params);
        }

 
        
        /**
          * Return match param
          * @param string $match 
          * @return string 
         */
         private function paramMatch($match)
         {
               if(isset($this->params[$match[1]]))
               {
                    return '('. $this->params[$match[1]] . ')';
               }
               return '([^/]+)';
         }



        /**
          * Replace param in path
          * 
          * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
          * 
          * @param string $replace 
          * @param callable $callback 
          * @return string
        */
         private function replacePattern()
         {
              return preg_replace_callback(
                             '#:([\w]+)#', 
                             [$this, 'paramMatch'], 
                             $this->path
                    );
         }

       
         
         /**
          * Get Url
          * @param array $params 
          * @return string
        */
        private function getUrl($params)
        {
            $path = $this->getPath();

            foreach($params as $k => $v)
            {
                $path = str_replace(":$k", $v, $path);
            } 
            return $path;
       }



       /**
        * Determine if has item in options
        * @param string $key 
        * @return bool
       */
       private function hasOption($key)
       {
           return isset(self::$options[$key]);
       }



       /**
        * Determine if has named route
        * @param string $name 
        * @return bool
       */
       private function hasNamedRoute($name): bool
       {
             return isset(self::$namedRoutes[$name]);
       }



       /**
        * Filter route
        * @return void
       */
       private function filterRoute()
       {
             if(is_string($this->callback) && $this->name === null)
             {
                   $this->setName($this->callback);
             }

             if($this->name)
             {
                  $this->addNamedRoute($this->name);
             }
       }


       /**
        * Manage prefix
        * @return void
       */
       private function addPrefix()
       {
             if($this->hasOption('prefix'))
             {
                 $optionPrefix = $this->getOption('prefix'); 

                 foreach(self::KEY_PREFIX as $index)
                 {
                     if(isset($optionPrefix[$index]))
                     {
                          call_user_func([$this, 'getPrefixed'. ucfirst($index)]);
                     }
                 }
                
             }

       }

       
       /**
        * Prepare callback
        * @return mixed
       */
       private function manageCallback()
       {
            if(is_string($this->callback))
            {
                if(strpos($this->callback, '@') !== false)
                {
                     list($controller, $action) = explode('@', $this->callback, 2);

                     $callback = [
                       'controller' => $controller,
                       'action'     => $action
                     ];
                }

            }else{

                $callback = $this->callback;
            }

            $this->setCallback($callback);
       }

       
       /**
        * Get prefixed path
        * @return string
       */
       private function getPrefixedPath()
       {
            $pathPrefix = $this->prefixItem('path');
            if($pathPrefix)
            {
                $path = trim($pathPrefix, '/') . '/' . $this->path;
                $this->setPath($path);
            }
       }
       
       /**
        * Get prefixed controller
        * @return string
       */
       private function getPrefixedController()
       {
           $controllerPrefix = $this->prefixItem('controller');
           $callback = $controllerPrefix . '\\' . $this->callback;
           $this->setCallback($callback);
       }


       /**
        * Get prefix item
        * @param string $key 
        * @return mixed
       */
       private function prefixItem($key)
       {
           return $this->getOption('prefix')[$key] ?: null;
       }

}