<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Exception;
use \Config;

/**
 * Database Manager
 * @package JK\Database\DatabaseManager
*/ 
final class DatabaseManager
{

private static $options = [
   PDO::ATTR_PERSISTENT => false,
   PDO::ATTR_EMULATE_PREPARES => 0, 
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];



/**
* @var \PDO $instance 
* @var  \JK\Database\DatabaseManager $instance
* @var  bool $autocreate [ it add fonctionnalite for create database if not exist ]
*/
private static $connection;
private static $instance;
private static $autocreate = false;

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
 * @param bool $autocreate [it for management autocreate database if not exist]
 * @return \PDO
*/
public static function instance($autocreate = false)
{
     if(is_null(self::$instance))
     {
         self::$autocreate = $autocreate;
         self::$instance = self::connect();

     }
     return self::$instance;
}


/**
* Make connection to \PDO
* @param string $dsn 
* @param string $user 
* @param string $password 
* @param array $options 
* @return \PDO
* @throws \Exception
*/
public static function make($dsn='', $user='', $password='', $options = [])
{
   self::addOptions($options);
   
   try 
   {
        $connection = new PDO($dsn, $user, $password, self::$options);
        self::createDBIfNotExist($connection);
        return $connection;
 
   }catch(PDOException $e){

        throw new Exception($e->getMessage(), 404);
   }

}



/**
  * Run connection to Database
  * @return \PDO
*/
private static function connect()
{
    return self::make(
          Config::get('database.dsn'),
          Config::get('database.user'),
          Config::get('database.password'),
          Config::get('database.options')
    );
    
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


/**
 * Create Database if not exist
 * @param \PDO $connection 
 * @param  string $database [ Name of database ]
 * @return void
*/
private static function createDBIfNotExist(\PDO $connection, $database='xxx')
{
  if(self::$autocreate === true)
  {
     /*
      $sql = sprintf('CREATE DATABASE IF NOT EXISTS `%s`', $database);
      if($connection->exec($sql))
      {
          echo 'Database created successfully!';
      }
     */
  }
}

}