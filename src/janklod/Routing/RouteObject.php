<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteObject
*/ 
class RouteObject
{
       
       /**
        * @var array $params      [ Route param ]
        * @var array $rgex        [ Route regex ]
        * @var array $options     [ Contain options ]
        * @var array $namedRoutes [ Contain named routes ]
        * @var \JK\Routing\RouteManager $routeManager 
       */
	     private $params  = [];
       private $regex   = [];
       private static $options = [];
       private static $namedRoutes = [];
       public $matches = [];
       private $routeManager;


       /**
        * Constructor
        * @param array $params 
        * @return void
       */
  	   public function __construct($params = [])
  	   {
            $this->addParams($params);
            $this->routeManager = new RouteManager($this);
  	   }

       
       /**
        * Do something before storage route in collection
        * @return void
       */
       public function beforeStore()
       {
            $this->routeManager->fiterRoute();
            $this->routeManager->addPrefix();
            $this->routeManager->dispatchCallback();
       }
 
       
       /**
        * Do something after storage route in collection
        * @return void
        */
       public function afterStore() {}


       /**
        * Add params
        * @param array $params 
        * @return void
       */
       public function addParams($params = [])
       {
            $this->params = $params;
       }


       /**
        * Add named route
        * @param string $name 
        * @return void
      */
       public function addNamedRoute($name)
       {
           self::$namedRoutes[$name] = $this;
       }


       /**
        * Add options
        * @param array $options 
        * @return void
       */
       public static function addOptions($options = [])
       {
            self::$options = $options;
       }

       
       /**
        * Get Option
        * @param string $key 
        * @return mixed
       */
       public function getOption($key)
       {
           return self::$options[$key] ?: null;
       }

      
       /**
        * Determine if has option
        * @param string $key 
        * @return bool
      */
       public function hasOption($key): bool
       {
           return isset(self::$options[$key]);
       }


       /**
        * Set route param
        * @param string $key 
        * @param mixed $value 
        * @return void
       */
       public function set($key, $value)
       {
            $this->params[$key] = $value;
       }



       /**
        * Get item from params
        * @param string $key 
        * @param mixed $value 
        * @return void
      */
       public function get($key)
       {
           return $this->has($key) ? $this->params[$key] : null;
       }



      /**
       * Determine if has item in params
       * @param string $key
       * @return bool
      */
      public function has($key): bool
      {
          return isset($this->params[$key]);
      }

     
     /**
      * Get all params
      * @return array
     */
     public function params()
     {
         return $this->params;
     }


     /**
      * Determine if parsed url match current route
      * @param string $url 
      * @return bool
     */
     public function match($url)
     {
          $url = trim($url, '/');
          $path = $this->replacePattern();
          $regex = "#^$path$#i";
          
          if(!preg_match($regex, $path, $matches))
          {
               return false;
          }
          
          array_shift($matches);
          $this->set('matches', $matches);
          $this->matches = $matches;
          return true;
     }

     

     /**
      * Return match param
      * Ex: ([^/]+)-([^/]+)
      * 
      * $match = Array
      * (
      *    [0] => :id [element to match]
      *    [1] => id  [param]
      * )
      *
      * Verify if isset $this->regex[$match[1]] = $this->regex['id']
      * if isset $this->regex['id'] , it'll remplace $this->regex['id'] by 
      *
      * @param string $match 
      * @return string 
     */
     public function paramMatch($match)
     {
           if(isset($this->regex[$match[1]]))
           {
                return '('. $this->regex[$match[1]] . ')';
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
     public function replacePattern()
     {
          return preg_replace_callback(
                         '#:([\w]+)#', 
                         [$this, 'paramMatch'], 
                         $this->get('path')
                );
     }


     /**
      * Add regex
      * 
      * @param string $param 
      * @param string $regex 
      * @return $this
      */
      public function with($param, $regex = null)
      {
           if(!is_null($regex))
           {
              $this->regex[$param] = str_replace('(', '(?:', $regex); 
           }

           if(is_array($param) && is_null($regex))
           {
                foreach($param as $index => $exp)
                {
                     $this->regex[$index] = str_replace('(', '(?:', $exp); 
                }
           }

           return $this;
      }

   
}