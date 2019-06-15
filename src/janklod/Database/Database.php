<?php 
namespace JK\Database;


use \Config;
use  JK\ORM\{
  Connection,
  Query 
};
use \Exception;



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
 * Open connection to the database
 * 
 * Ex: Database::open();
 * Ex: Database::open('DB');
 * 
 * @return void
*/
public static function open($alias='')
{
   # check connection
   $driver = Config::get('database.connection');
   $config = self::config($driver);
   self::$connection = Connection::make($driver, $config, 'Query');

   # add alias
   if($alias) { class_alias(__CLASS__, $alias); }
}


/**
 * connect connection 
 * Database::open('DB');
 * 
 * Database::connect('users')->findAll();
 * Database::connect()->pdo() \PDO
 * 
 * @param string $table 
 * @return mixed
 * @throws \Exception
*/
public static function connect($table='')
{
     if(self::$connection)
     {
     	  if($table !== '')
     	  {
     	  	   return Query::table($table);
     	  }
     	  return new static;

     }else{

     	  throw new Exception('No connection checked!');
     }
}


/**
 * Execute query SQL
 * 
 * Database::execute('SELECT * FROM my_table WHERE id = ?', [3]);
 * Database::execute('SELECT * FROM my_table WHERE id = :id', ['id' => 3]);
 * 
 * $sql = 'SELECT * FROM my_table';
 * Database::execute($sql)->results(); // first, ...
 * 
 * @param string $sql 
 * @param array $params 
 * @return \Query
 */
public static function execute($sql, $params=[])
{
    return Query::execute($sql, $params);
}




/**
 * Get PDO
 * 
 * Database::connect()->pdo() \PDO
 * 
 * @return null|\PDO
*/
public function pdo(): ?PDO
{
	 return Connection::pdo();
}


/**
 * Deconnection to the database
 * 
 * @return 
*/
public static function close() {}


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