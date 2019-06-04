<?php 
namespace JK\Database;


use \PDO;
use \PDOException;


/**
 * @package JK\Database\Connection
*/ 
class Connection
{

/**
 * @var array $options  [ Default Optional params for PDO ]
 * @var array $messages [ Contain Messages info ]
*/
private static $options = [
   PDO::ATTR_PERSISTENT => false,
   PDO::ATTR_EMULATE_PREPARES => 0, 
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

private static $message = [];

const CONFIG_KEYS = [
 'dsn', 
 // 'driver',
 // 'name',
 // 'host',
 // 'charset',
 // 'port',
 'username',
 'password',
 'options', 
 'prefix_tbl',
 'collation',
 'engine',
 'autocreate',
];


/**
 * Make connection
 * @param array $config 
 * @return \PDO 
*/
public static function make($config = [])
{
   self::ensureConfig($config);
   
   try 
   {
       extract($config);
       self::addOptions($options);
       $connection = new PDO($dsn, $username, $password, self::$options);

       /*
       This fonctionnality will be added later
       if($autocreate === true)
       { 
          self::createDBIfNotExist($connection); 
       }
       */

       return $connection;
         
   }catch(PDOException $e){

        throw new ConnectionException($e->getMessage(), 404);
   }

}


/**
 * Get messages
 * @return array
*/
public static function message()
{
   return self::$messages;
}


/**
 * Create Database if not exist
 * @param \PDO $connection 
 * @param  string $database [ Name of database ]
 * @return void
*/
private static function createDBIfNotExist(\PDO $connection, $database='xxx')
{
      # in this part we must to make sure connection
      $sql = sprintf('CREATE DATABASE IF NOT EXISTS `%s`', $database);
      if($connection->query($sql))
      {
          echo 'Database created successfully!';
      }
      $connection->query(
        sprintf('use %s', $database)
      );
}


/**
 * Add options params
 * @param array $options 
 * @return void
*/
public static function addOptions($options=[])
{
   if(!empty($options))
   {
       self::$options = array_merge(self::$options, $options);
   }
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
      if(!in_array($key, self::CONFIG_KEYS))
      {
          exit(
            sprintf('Sorry, this config key [%s] does not match!', $key)
          );
      }
   }
}


}