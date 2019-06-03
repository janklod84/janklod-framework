<?php 
namespace JK\Database;


/**
 * @package JK\Database\Query 
*/ 
class Query 
{
      
/**
* @var PDO $connection
* @var \PDOStatement $statement
* @var bool $executed
* @var string $sql
*/
private static $connection;
private static $statement; 
private static $executed = false;
private static $sql = '';


/**
 * Excecute query
 * @param string $sql
 * @param array $params
 * @return \PDOStatement
*/
public static function execute(string $sql, array $params=[])
{
   try
   {
   	  self::$sql = $sql;
   	  self::$connection = DatabaseManager::instance();
   	  self::$statement  = self::$connection->prepare($sql);
      if(self::$statement->execute($params))
      {
      	   self::$executed = true;
      }
      return self::$statement ?: new \stdClass();
 
   }catch(\PDOException $e){
      
      $this->failedMsg($e);
   }

}


/**
 * Fetch all Results
 * @return array
*/
public function all()
{
	return self::$statement->fetchAll();
}


/**
 * Fecth one result
 * @return array
*/
public function one()
{
	return self::$statement->fetch();
}



/**
 * Return row affected count
 * @return int
*/
public function count()
{
	return self::$statement->rowCount();
}


/**
 * Return last insert id after insertion data
 * @return int
*/
public function lastId()
{
	return self::$connection->lastInsertId();
}


/**
 * Show message if query does not executed
 * @param \PDOException $e
 * @return bool
*/
private function failedMsg($e)
{
  self::$executed = false;
  $html  = '<h3>Sorry your querie does not executed yet!</h3>';
  $html .= '<h4>Error Mysql: </h4>';
  $html .= '<p>' . $e->getMessage() . '</p>';
  $html .= '<h4>Last Query: </h4>';
  $html .= '<p>' . self::$sql . '</p>';
  echo $html;
  exit;
}


/**
 * Determine status execution
 * if executed that mean all perfect otherwise has error
 * @return bool
*/
public function executed(): bool
{
	return self::$executed;
}


}