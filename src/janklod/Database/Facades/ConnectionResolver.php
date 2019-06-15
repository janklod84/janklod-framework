<?php 
namespace JK\Database\Facades;


use \Query;
use \Config;
use JK\ORM\Connection;


/**
 * @package JK\Database\Facades\ConnectionResolver
*/
class ConnectionResolver
{

 
/**
* Get connection alternance
* 
* @param string $table 
* @return PDO|Query
*/
public static function get($table='')
{
   $driver = Config::get('database.connection');
   $config = self::config($driver);
   $connection = Connection::make($driver, $config);
   if($table !== '')
   {
   	  $connection = Query::setup($connection, $table);
   }
   return $connection;
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