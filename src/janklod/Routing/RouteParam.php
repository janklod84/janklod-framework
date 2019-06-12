<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteParam 
*/
class RouteParam 
{
	 
/**
* @var  string  $path         [ Route path     ]
* @var  string  $pattern      [ Route pattern  ]
* @var  mixed   $callback     [ Route callback ]
* @var  string  $name         [ Route name     ]
* @var  string  $method       [ Route method   ]
* @var  array   $regex        [ Route regex    ]
* @var  array   $namedRoutes  [ Named routes   ]
*/
private $path;
private $callback;
private $name;
private $method;
private $regex = [];
private static $namedRoutes = [];


/**
 * Constructor
 * 
 * @param   string   $path 
 * @param   string   $callback 
 * @param   string   $name 
 * @param   string   $method 
 * @return  void
 */
public function __construct($path, $callback, $name=null, $method='GET')
{
    $this->setPath($path);
    $this->setCallback($callback);
    $this->setName($name);
    $this->setMethod($method);
}



/**
 * Set path
 * 
 * @param string $path 
 * @return void
*/
public function setPath($path)
{
    $this->path = $path;
}


/**
 * Get path
 * 
 * @return string
*/
public function path()
{
    return $this->path;
}


/**
 * Set callback
 * 
 * @param string $callback 
 * @return void
*/
public function setCallback($callback)
{
    $this->callback = $callback;
}


/**
 * Get callback
 * 
 * @return string
*/
public function callback()
{
    return $this->callback;
}


/**
 * Set method
 * 
 * @param string $method 
 * @return void
*/
public function setMethod($method)
{
    $this->method = $method;
}


/**
 * Get request method
 * 
 * @return string
*/
public function method()
{
    return $this->method;
}


/**
 * Set name
 * 
 * @param string $name 
 * @return void
*/
public function setName($name)
{
    $this->name = $name;
}


/**
 * Get name
 * 
 * @return string
*/
public function name()
{
    return $this->name;
}


/**
 * Add named routes
 * 
 * @param string $name 
 * @return void
*/
public function namedRoutes($name)
{
   self::$namedRoutes[$name] = $this;
}


/**
 * Do somes actions before storage
 * 
 * @return void
*/
public function beforeStorage()
{
	if(is_string($this->callback) && $this->name === null)
    {
          $this->setName($this->callback);
    }

    if($this->name)
    {
         $this->namedRoutes($this->name);
    }
}



}