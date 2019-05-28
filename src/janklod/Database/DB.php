<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Exception;
use \Config;

/**
 * Database Manager
 * @package JK\Database\DB
*/ 
final class DB
{
    
/**
* @var \PDO $instance 
* @var  \JK\Database\DB $instance
*/
private static $connection;
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
* Constructor
* @return void
*/
private function __construct() 
{
    if(!self::isConnected())
    {
         self::open();
    }
}


/**
* Determine if has connection
* @return bool
*/
private static function isConnected()
{
     return self::$connection instanceof \PDO;
}


/**
  * Run connection to Database
  * @return void
*/
private static function connect()
{
    return Connection::make(
          Config::get('database.dsn'),
          Config::get('database.user'),
          Config::get('database.password'),
          Config::get('database.options')
    );
    
}


/**
* Open connection
* @return void
*/
public static function open()
{
    self::$connection = self::instance();
}


/**
* Close current connection
* @return void
*/
public static function close()
{
    self::$connection = null;
} 



/**
 * Get instance of database
 * @return self
*/
public static function instance()
{
     if(is_null(self::$instance))
     {
         self::$instance = self::connect();
     }
     return self::$instance;
}


}