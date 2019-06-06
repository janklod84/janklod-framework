<?php 
namespace JK\Database;


use \Config;
use JK\Database\Configs\{
	MySQLConfig,
	SQLiteConfig
};


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
 * Open Database
 * @param array $config
 * @return void
*/
private static function connect()
{
	$driver = Config::get('database.driver');
	$config = self::config($driver);
	return Connection::make($driver, $config);
}


/**
 * Get configuration
 * @var string $driver
 * @return array
 * @throws \Exception
*/
private static function config($driver)
{
  switch($driver)
  {
    case 'mysql':
      return MySQLConfig::get();
    break;
    case 'sqlite':
      return SQLiteConfig::get();
    break;
    default:
     throw new \Exception("No Driver checked!", 404);
  }
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