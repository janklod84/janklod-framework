<?php 
namespace JK\Routing\Route;


/**
 * @package JK\Routing\Route\Route 
*/ 
class Route 
{
      
/**
* @var  array $options
*/
private static $options  = [];



/**
* Add routes by method GET
* 
* Ex: Route::get('/', 'HomeController@index', 'welcome.page');
* Ex: Route::get('/about', function() {
*      echo 'HI Friends!';
* });
* 
* Ex: Route::get('/contact', [
*  'controller' => 'HomeController',
*  'action'     => 'contact'
* ], contact.me);
* 
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteManager
*/
public static function get(
string $path, 
$callback, 
string $name = null
)
{
    return self::add($path, $callback, $name, 'GET');
}


/**
* Add routes by method POST
* 
* Ex: Route::post('/contact', 'HomeController@send');
* 
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteManager
*/
public static function post(
string $path, 
$callback, 
  string $name = null
)
{
    return self::add($path, $callback, $name, 'POST');
}


/**
* Add new package or resources of routes
* 
* @param string $path
* @param string $controller
* @return 
*/
public static function package(string $path, string $controller)
{
     self::get("$path", "$controller@index");
     self::post("$path/add", "$controller@add");
     self::post("$path/submit", "$controller@submit");
     self::post("$path/edit/:id", "$controller@edit");
     self::post("$path/save/:id", "$controller@save");
     self::post("$path/delete/:id", "$controller@delete");
}



/**
* Add routes group
* 
* @param array $options
* @param \Closure $callback
* @return void
*/
public static function group($options = [], \Closure $callback)
{  
    self::addOptions($options);
    call_user_func($callback); 
    self::cleanOptions();
}


/**
* Add routes group
* 
* @param array $prefixes
* @param \Closure $callback
* @return void
*/
public static function prefix($prefixes = [], \Closure $callback)
{  
    self::addOption('prefix', $prefixes);
    return self::group($prefixes, $callback);
}



/**
 * Get URL Named route
 * @param string $name 
 * @param array $params 
 * @return string
*/
public static function url(string $name, array $params = [])
{
       return RouteManager::url($name, $params);
}


/**
* Add routes by request GET
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteManager
*/
public static function add(
$path, 
$callback, 
$name = null,  
$method = 'GET'
)
{
     # route custom
     $route = new RouteManager([
        'path'        => $path, 
        'pattern'     => self::generatePattern($path),
        'callback'    => $callback,
        'name'        => $name,
        'method'      => $method,  
        'prefix'      => self::getOption('prefix'),
        'middleware'  => false,   
        'module'      => false
     ]);
    
     # route filter
     if(is_string($callback) && $name === null)
     {
          $route->setParam('name', $callback);
     }

     if($name)
     {
         $route->namedRoutes($name);
     }

     # prepare callback
     // $route->mapCallback($callback);


     # store route by method
     RouteCollection::store($method, $route);
     return $route;
}


/**
 * Item maper
 * @param string $path
 * @return mixed
*/
public static function generatePattern($path)
{
    return '#^'. trim($path, '/') . '$#';
}


/**
 * Push Options
 * @param array $options 
 * @return void
*/
public static function addOptions($options = [])
{
      self::$options = array_merge(self::$options, $options);
}


/**
 * Add Option
 * @param string $key 
 * @param string $value 
 * @return void
*/
public static function addOption($key, $value)
{
      self::$options[$key] = $value;
}


/**
 * remove Option item
 * @param string $key  
 * @return void
*/
public static function removeOption($key)
{
     if(self::hasOption($key))
     {
         unset(self::$options[$key]);
     }
}

/**
 * Clean all options
 * @return void
*/
public static function cleanOptions()
{
      self::$options = [];
}


/**
 * Determine if has option param
 * @param string $key 
 * @return bool
*/
public static function hasOption($key)
{
    return array_key_exists($key, self::$options);
}


/**
 * Get options
 * @param string $key 
 * @return mixed
*/
public static function getOption($key)
{
     if(self::hasOption($key))
     {
         return self::$options[$key];
     }
     return null;
}


/**
 * Map prefixed Path
 * @param string $path 
 * @return string
*/
public static function pathPrefixed($path)
{
    $prefix = $this->getOption('prefix.path');

}


}