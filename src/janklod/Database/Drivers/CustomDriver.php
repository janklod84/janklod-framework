<?php 
namespace JK\Database\Drivers;


use \PDO;


/**
 * @package JK\Database\Drivers\CustomDriver 
*/ 
abstract class CustomDriver 
{


/**
 * @var array $options  [ Default Optional params for PDO ]
 * @var array $config   [ Config array ]
*/
protected static $options = [
   PDO::ATTR_PERSISTENT => false,
   PDO::ATTR_EMULATE_PREPARES => 0, 
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

protected static $config;

/**
 * Constructor
 * @param array $config 
 * @return void
*/
public function __construct($config=[])
{
	self::$config = $config;
}


/**
 * Connect to PDO
 * @return \PDO
*/
abstract public function connect();


/**
 * Get DSN
 * @return string
*/
abstract public function getDsn();


/**
 * Get config item
 * @param string $item 
 * @return mixed
 * @throws \Exception 
*/
public function config($item)
{
   if(!isset(self::$config[$item]))
   {
       throw new \Exception("Config item [$item] is not setted", 404);
   }
   return self::$config[$item];
}

}