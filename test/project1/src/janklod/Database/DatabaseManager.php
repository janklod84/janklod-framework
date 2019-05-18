<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Exception;


/**
 * @package JK\Database\DatabaseManager
*/ 
final class DatabaseManager
{
    
/**
* @var \PDO $instance 
* @var  Database $instance
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
   self::open();
}


/**
* Determine if has connection
* @return bool
*/
public static function isConnected()
{
   self::$connection instanceof \PDO;
}



/**
* Open connection
* @return void
*/
public static function open()
{
	  if(!self::isConnected())
	  {
	  	  self::$connection = self::getPDO();
	  }
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
 * Get Database Connection PDO Object
 * @return \PDO
*/
public static function connect()
{
     return self::$connection;
}


/**
 * Get instance of database
 * @return self
*/
public static function instance()
{
     if(is_null(self::$instance))
     {
         self::$instance = self::getPDO();
     }
     return self::$instance;
}


/**
 * Exceute statement
 * @param string $sql 
 * @param array $params 
 * @return \PDOStatement
*/
public function query($sql, $params = [])
{
 	
}


/**
  * Run connection to Database
  * @return void
*/
private static function getPDO()
{
    return DatabaseConnection::make(
        	DatabaseConfig::dsn(),   
        	DatabaseConfig::user(),  
        	DatabaseConfig::password(),  
        	DatabaseConfig::options()
        );
}

     
}