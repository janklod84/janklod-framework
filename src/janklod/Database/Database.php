<?php 
namespace JK\Database;


use \Config;


/**
 * Database Manager
 * @package JK\Database\Database
*/ 
final class Database
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
 * @return \PDO 
*/
private static function connect()
{
	$connection = Config::get('db.connection');
	$config = self::config($connection);
  echo '<pre>';
  print_r($config);
  echo '</pre>';

	return Connection::make($connection, $config);
}


/**
 * Get config by driver
 * 
 * @param string $key
 * @return array
 */
public static function config($key)
{
     $data = Config::retrieveGroup('db');
     if(!empty($data[$key]))
     {
         $data = $data[$key];
     }
     return $data ?? [];
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