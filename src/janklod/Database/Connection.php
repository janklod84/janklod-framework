<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use JK\Database\Exceptions\{
	ConnectionException,
	DriverException
};

use JK\Database\Drivers\{
   MySQLDriver,
   SQLiteDriver
};

use \Config;

/**
 * @package JK\Database\Connection
*/ 
class Connection 
{

/**
 * @const array [ allowed keys ]
*/
const ALLOWED_CONFIG_KEYS = [
 'dbname',
 'host',
 'charset',
 'port', 
 'username',
 'password',
 'options', 
 'prefix_tbl',
 'collation',
 'engine',
 'autocreate',
];


private static $message = [];


/**
 * Make connection
 * @param string $driver
 * @param array $config 
 * @return \PDO 
*/
public static function make($driver='', $config = [])
{
   try 
   {
   	   self::ensureConfig($config);
       extract($config);
   	   if(self::ensureDriver($driver))
   	   {
   	   	   $method = strtolower($driver);
   	   	   $callback = [new static, $method];
   	   	   if(!is_callable($callback))
   	   	   {
                throw new ConnectionException(
                	sprintf('Sorry, Connection to [%s] does not implemented yet!', $driver), 
                	404
                );
                
   	   	   }
   	   	   return call_user_func($callback, $config);
   	   }
       
       // $connection = new PDO($dsn, $username, $password, self::$options);
       
       // return $connection;
         
   }catch(PDOException $e){

        throw new ConnectionException($e->getMessage(), 404);
   }

}


/**
 * Call MySQL connection
 * @param array $config 
 * @return \PDO
*/
public static function mysql($config=[])
{
    return call_user_func([new MySQLDriver($config), 'connect']);
}


/**
 * Call SQLite connection
 * @param array $config 
 * @return \PDO
*/
public static function sqlite($config=[])
{
   return call_user_func([new SQLiteDriver($config), 'connect']);
}


/**
 * Make sure has available driver
 * @param string $driver 
 * @return 
*/
private static function ensureDriver($driver=null)
{
     if(!in_array($driver, PDO::getAvailableDrivers(), true))
     {
     	  throw new DriverException("Current driver is not available!", 404); 
     }
     return true;
}


/**
 * Make sure config params matches
 * @param array $config 
 * @return void
*/
private static function ensureConfig($config)
{
   foreach(array_keys($config) as $key)
   {
      if(!in_array($key, self::ALLOWED_CONFIG_KEYS))
      {
          throw new ConnectionException(
            sprintf('Sorry, this config key [%s] does not match!', $key)
          );
      }
   }
}


/**
 * Add options params
 * @param array $options 
 * @return void
*/
private static function addOptions($options=[])
{
   if(!empty($options))
   {
       return array_merge(self::$options, $options);
   }
}


}