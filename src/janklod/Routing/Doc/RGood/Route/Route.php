<?php 
namespace JK\Routing\Route;


/**
 * @package JK\Routing\Route\Route 
*/ 
class Route 
{
      
/**
* @var  array $options
* @var  bool  $notFound
*/
private static $options = [];


/**
* Add routes by method GET
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteCustomer
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
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteCustomer
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
* It's used for CRUD for example
* 
* @param string $path
* @param string $controller
* @return self
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
    self::$options = $options;
    call_user_func($callback); 
    self::$options = [];
}


/**
* Add routes group
* 
* @param array $options
* @param \Closure $callback
* @return void
*/
public static function prefix($options = [], \Closure $callback)
{  
    self::$options['prefix'] = $options;
    self::group(self::$options, $callback);
}



/**
 * Get URL Named route
 * @param string $name 
 * @param array $params 
 * @return string
*/
public static function url(string $name, array $params = [])
{
    return RouteCustomer::url($name, $params);
}




/**
* Add routes by request GET
* @param string $path 
* @param mixed $callback 
* @param string $name 
* @return RouteCustomer
*/
public static function add(
$path, 
$callback, 
$name = null,  
$method = 'GET'
)
{
     # route custom
     $route = new RouteCustomer();
     $route->options(self::$options);
     $route->setParam('path', $route->preparePath($path));
     $route->setParam('callback', $callback);
     $route->setParam('name', $name);
     $route->setParam('method', $method);
     $route->setOption('prefix');

     # route filter
     if(is_string($callback) && $name === null)
     {
          $route->setParam('name', $callback);
     }

     if($name)
     {
         $route->namedRoute($name);
     }

     # prepare callback
     $route->mapCallback($callback);


     # store route by method
     RouteCollection::store($method, $route);
     return $route;
}


/**
* Get option
* @param string $key 
* @return mixed
*/
protected static function getOption($key='')
{
     return self::$options[$key] ?? '';
}

}