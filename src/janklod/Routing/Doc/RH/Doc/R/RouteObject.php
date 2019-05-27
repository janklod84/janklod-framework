<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteObject
*/ 
class RouteObject
{
       
/**
 * @var array  $params      [ Route Params ]
 * @var array  $regex       [ Route regex ]
 * @var array  $namedRoutes [ Named Routes ]
*/ 
private $params  = [];
private $regex   = [];
private static $namedRoutes = [];


/**
 * Constructor
 * @param array $params 
 * @return void
*/
public function __construct($params = [])
{
     $this->add($params);
}


/**
 * Add Params
 * @param array $params 
 * @return void
*/
public function add($params = [])
{
     $this->params = $params;
}


/**
 * Set item of params
 * @param string $key 
 * @param mixed $value 
 * @return void
*/
public function set($key, $value)
{
      $this->params[$key] = $value;
}

/**
 * Determine if isset item
 * @param string $key 
 * @return bool
*/
public function has($key): bool
{
    return isset($this->params[$key]);
}


/**
 * Get item param current route
 * @param string $key 
 * @return mixed
*/
public function get($key = null)
{
    return $this->has($key) ? $this->params[$key] : null;
}


/**
 * Get all params curren route
 * @return array
*/
public function parameters()
{
     return $this->params ?? [];
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
 * Get Url
 * @param type $name 
 * @param type|array $params 
 * @return type
*/
public static function url($name, $params = [])
{
     if(!isset(self::$namedRoutes[$name]))
     {
           return false;
     }

     return self::$namedRoutes[$name]->getUrl($params);
}


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
     $this->set('matches', $matches);
     return true;
}


/**
* Add regex
* @param mixed $param 
* @param mixed $regex 
* @return $this
*/
public function with($parameter, $regex = null)
{
     if(is_array($parameter) && is_null($regex))
     {
          foreach($parameter as $index => $exp)
          {
               # recursive
               $this->with($index, $exp);
          }

     }else{
    
         $this->regex[$parameter] = str_replace('(', '(?:', $regex); 
    }
    
    $this->set('regex', $this->regex);
    return $this;
}


/**
* Do something before storage
* @return void
*/
public function beforeStore()
{
   $this->filterRoute();
   $this->addPrefix();
   $this->prepareCallback();
}


/**
* Do something after storage
* @return void
*/
public function afterStore() {}




/**
* Filter route
* @return void
*/
private function filterRoute()
{
     if(is_string($this->get('callback')) && $this->get('name') === null)
     {
           $this->set('name', $this->get('callback'));
     }

     if($name = $this->get('name'))
     {
          $this->addNamedRoute($name);
     }
}



/**
* Add prefix
* @return type
*/
private function addPrefix()
{
  if(!empty($this->params['prefix']['path']))
  {
      $path = trim($this->params['prefix']['path'], '/') . '/'. $this->get('path');
      $this->set('path', trim($path, '/'));
  }

  if(!empty($this->params['prefix']['controller']))
  {
       $callback = $this->params['prefix']['controller'] . '\\' . $this->get('callback');
       $this->set('callback', $callback);
  }
}





/**
* Prepare callback
* @return mixed
*/
private function prepareCallback()
{
    if(is_string($this->get('callback')))
    {
        if(strpos($this->get('callback'), '@') !== false)
        {
             list($controller, $action) = explode('@', $this->get('callback'), 2);

             $callback = [
               'controller' => $controller,
               'action'     => $action
             ];
        }

    }else{

        $callback = $this->get('callback');
    }

    $this->set('callback', $callback);
}


/**
  * Return match param
  * @param string $match 
  * @return string 
*/
private function paramMatch($match)
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
 private function replacePattern()
 {
      return preg_replace_callback(
                     '#:([\w]+)#', 
                     [$this, 'paramMatch'], 
                     $this->get('path')
            );
 }


 /**
  * Get Url
  * @param array $params 
  * @return string
*/
private function getUrl($params)
{
    $path = $this->get('path');

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
}

}