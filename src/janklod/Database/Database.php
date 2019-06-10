<?php 
namespace JK\Database;


use \Config;


/**
 * Database Manager
 * @package JK\Database\Database
*/ 
final class Database
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
 * Connect to database
 * @return \PDO 
*/
private static function connect()
{
	$connection = Config::get('database.connection');
	$config = self::config($connection);
	return Connection::make($connection, $config);
}


/**
 * Get config by driver
 * 
 * @param string $key
 * 
 * @return array
 */
private static function config($key=null)
{
     $data = Config::retrieveGroup('database');
     if(!empty($data[$key]))
     {
         $data = $data[$key];
     }
     return $data ?? [];
}

}