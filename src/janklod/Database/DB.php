<?php 
namespace JK\Database;


use \Config;


/**
 * Database Manager
 * @package JK\Database\DB
*/ 
final class DB
{


/**
* @var  \PDO  $instance    [ Connection instance ]
*/
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
 * Connect to database
 * @param array $config
 * @return void
*/
private static function connect()
{
	$driver = Config::get('database.driver');
	$config = Configuration::check($driver);
	return Connection::make($driver, $config);
}



/**
 * Excecute Query
 * Ex: DB::execute('SELECT * FROM `users`')->fetchAll();
 * @param string $sql 
 * @param array $params 
 * @return \PDOStatement
*/
public static function execute($sql, $params=[])
{
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
     return self::instance()->exec($sql);
}


}