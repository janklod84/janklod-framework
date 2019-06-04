<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Exception;


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
 'username',
 'password',
 'options', 
 'autocreate'
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
       
       /**
       if($autocreate === true)
       {
          exec('CREATE DATABASE IF NOT EXISTS `%s`', $database);
          if($connection->exec($sql))
          {
              self::$message['created'][] = sprintf(
                'Database %s created successfully!', $database
              );
          }
       }
       */
       return $connection;
         
   }catch(PDOException $e){

        throw new Exception($e->getMessage(), 404);
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
 * Make sure config params matches
 * @param array $config 
 * @return type
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

/**
 * Add options params
 * @param array $options 
 * @return void
*/
private static function addOptions($options=[])
{
   if(!empty($options))
   {
       self::$options = array_merge(self::$options, $options);
   }
}


     
}