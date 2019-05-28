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
    try
    {
        $driver = self::config('driver'); 
        
        if(!in_array($driver, PDO::getAvailableDrivers(), true))
        {
            exit('Error Available driver');
            throw new Exception(
              'Error Driver, Cannot work without a proper database setting up', 
              404
            );
        }

        return call_user_func([new static, $driver]);

     }catch(PDOException $pdoEx){

           die($pdoEx->getMessage());
     }

    /*
    return Connection::make(
          Config::get('database.dsn'),
          Config::get('database.user'),
          Config::get('database.password'),
          Config::get('database.options')
    );

    $driver = Config::get('database.driver');
    if($driver === '')
    {
       die('Error driver');
    }

    call_user_func([$this, $driver]);
    */
}

/**
 * Get database configuration
 * @param  $key 
 * @return mixed
*/
public static function config($key='')
{
    if(!$key) { return false; }
    return Config::get('database.'. $key);
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


/**
 * Connection to mysql
 * @return \PDO connection
*/
public static function mysql()
{
    die('OK');
    //return new \JK\Drivers\MySQL('mysql', []);
}


public static function sqlite()
{
    return new \JK\Drivers\SQLite('sqlite', []);
}


}