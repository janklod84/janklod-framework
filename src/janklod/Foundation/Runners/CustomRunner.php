<?php 
namespace JK\Foundation\Runners;

use JK\Config\Config;
use JK\Foundation\Configuration;



/**
 * @package JK\Foundation\Runners\CustomRunner 
*/
abstract class CustomRunner 
{


/**
 * @var \JK\Container\ContainerInterface $app
*/
protected $app;


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
 * Merge data
 * @param string $key 
 * @return array
*/
protected static function get($key)
{
   $config = Config::get('app.'.$key) ?: []; 
   return array_merge(Configuration::SRC[$key], $config);
}

} 