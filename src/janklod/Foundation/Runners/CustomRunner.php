<?php 
namespace JK\Foundation\Runners;

use JK\Config\Config;
use JK\Foundation\Source;



/**
 * @package JK\Foundation\Runners\CustomRunner 
*/
abstract class CustomRunner  
{


/**
 * @var \JK\Container\ContainerInterface $app [ Container ]
 * @var array $initialized [ Container all initialized ]
*/
protected $app;
protected static $initialized = [];

/**
* Construct
* @param \JK\Container\ContainerInterface
* @return void
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
 * Callback
 * @param callable $callback 
 * @return mixed
*/
protected function call(callable $callback, $arguments=[])
{
    call_user_func_array($callback, $arguments);
}

/**
 * Merge data
 * @param string $key 
 * @return array
*/
protected static function get($key)
{
   $config = Config::get('app.'.$key) ?: []; 
   return array_merge(Source::CONFIG[$key], $config);
}

} 