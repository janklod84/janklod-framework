<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use JK\Database\DatabaseException;
use JK\Config\Config;

/**
 * Database Manager
 * @package JK\Database\DB
*/ 
final class DB
{


/**
* @var  \PDO  $connection  [ PDO exception ]
* @var  \PDO  $instance    [ Connection instance ]
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
 * Show message if already connected
 * @return void
*/
private static function alreadyConnected()
{
  if(self::isConnected())
  {exit('You are already connected to Database!');}
}


/**
* Make sure has connected
* @return void
*/
private static function ensureConnected()
{
   if(!self::isConnected())
   {exit('You must to add connection!');}
}


/**
 * Get connection
 * @param array $config
 * @return \PDO
*/
public static function connect($config = [])
{
     self::alreadyConnected();
     if(!self::isConnected())
     {
         $defaults = [
          'dsn'        => Config::get('database.dsn'),
          'username'   => Config::get('database.user'),
          'password'   => Config::get('database.password'),
          'options'    => Config::get('database.options'),
          'autocreate' => false
        ];
        $config = $config ?: $defaults;
        self::$connection = Connection::make($config);
     }
     return self::$connection;
}


/**
* Close current connection
* @return void
*/
public static function deconnect()
{
    self::ensureConnected();
    self::$connection = null;
} 


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
 * Excecute Query
 * Ex: DatabaseManager::execute('SELECT * FROM `users`')->fetchAll();
 * @param string $sql 
 * @param array $params 
 * @return \PDOStatement
*/
public static function execute($sql, $params=[])
{
   self::ensureConnected();
   try
   {
      self::instance()->beginTransaction();
      $stmt = self::instance()->prepare($sql);
      $stmt->execute($params);
      self::instance()->commit();
      return $stmt;

   }catch(\PDOException $e){
      self::instance()->rollback();
      throw new DatabaseException($e->getMessage(), 404);
   }

}


/**
 * Excecute Query
 * @param string $sql 
 * @return bool
*/
public static function exec($sql)
{
     self::ensureConnected();
     return self::instance()->exec($sql);
}


}