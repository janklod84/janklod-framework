<?php 
namespace JK\Database;


use \Config;
use JK\Database\Config\{
	MySQLConfig,
	SQLiteConfig
};


/**
 * Database Manager
 * @package JK\Database\DB
*/ 
final class DB
{


/**
* @var  \PDO  $instance    [ Connection instance ]
*/
private static $instance;

/**
* prevent instance from being cloned
* @return void
*/
private function __clone(){}



/**
* prevent instance from being unserialized
* @return void
*/
private function __wakeup(){}



/**
 * Get connection
 * @return \PDO
*/
public static function instance()
{
    if(is_null(self::$instance))
    {
        self::$instance = self::connect();
    }
    return self::$instance;
}


/**
 * Open Database
 * @param array $config
 * @return void
*/
private static function connect()
{
	$driver = Config::get('database.driver');
	$config = self::config($driver);
	return Connection::make($driver, $config);
}


/**
 * Get configuration
 * @var string $driver
 * @return array
 * @throws \Exception
*/
private static function config($driver)
{
  switch($driver)
  {
    case 'mysql':
      return MySQLConfig::all();
    break;
    case 'sqlite':
      return SQLiteConfig::all();
    break;
    default:
     throw new \Exception("No Driver checked!", 404);
  }
}


}