<?php 
namespace JK\Database\Statement;


use \PDO;
use \PDOException;


/**
 * @package JK\Database\Statement\Query 
*/ 
class Query 
{

/**
* @var  \PDO            $connection   [ Object PDO ]
* @var  \PDOStatement   $statement    [ PDOStatement ]
* @var  string          $sql          [ SQL request ]
* @var  array           $result       [ Result query ]
* @var  int             $count        [ Row affected count ]
* @var  int             $lastID       [ Last insert id ]
* @var  array           $arguments    [ ]
* @var  array           $queries      [ Total executed SQL queries ]
* @var  bool            $error        [ Error status ]
* @var  bool            $executed     [ Excecution status ]
* @var  bool            $connected    [ Connection status ]
* @var  string          $fetchHandler [ FetchMode handler ]
*/
protected static $connection;
protected static $statement;
protected static $sql;
protected static $result;
protected static $count;
protected static $lastID;
protected static $arguments = [];
protected static $queries   = [];
protected static $error     = false;
protected static $executed  = false;
protected static $connected = false;
// protected static $fetchHandler = 'FetchObject';


// Fetch handler namespace
// const FH_NS = '\\JK\\Statement\\Fetch\\%s';


/**
* Constructor
* 
* @param \PDO $connection
* @return void
*/
public static function setup(PDO $connection)
{
    self::$connection = $connection;
    self::$connected  = true;
    return new static;
}


/**
 * Execute simple query
 * 
 * @param string $sql 
 * @return bool
*/
public static function exec($sql='')
{
    return self::$connection 
                 ->exec($sql);
}


/**
 * Set alias of class
 * 
 * @param string $alias 
 * @return void
*/
public function alias($alias='Q')
{
   class_alias(__CLASS__, $alias);
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
   $this->sql = $sql;
   try
   {
      self::$connection->beginTransaction();
      $stmt = self::$connection->prepare($sql);
      $stmt->execute($params);
      self::$connection->commit();

   }catch(\PDOException $e){
      self::$connection->rollback();
      throw new QueryException($e->getMessage(), 404);
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