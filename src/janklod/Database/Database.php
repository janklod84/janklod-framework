<?php 
namespace JK\Database;


use \Config;
use  JK\ORM\Connection;



/**
 * Database Manager
 * @package JK\Database\Database
*/ 
final class Database
{


/**
 * @var  connection
*/
private static $connection;



/**
 * Connection to the database
 * 
 * @return void
*/
public static function connect()
{
	 $driver = Config::get('database.connection');
     $config = self::config($driver);
     self::$connection = Connection::make($driver, $config, 'Query');
}


/**
 * Deconnection to the database
 * 
 * @return 
*/
public static function deconnect()
{
    if(self::$connection)
    {
    	 self::$connection = null;
    }
}


/**
 * Get config by driver
 * 
 * @param string $key
 * @return array
 */
public static function config($key=null)
{
   $data = Config::retrieveGroup('database');
   if(!empty($data[$key]))
   {
       $data = $data[$key];
   }
   return $data ?? [];
}

}