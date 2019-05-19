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
* @var string $sql
* @var \PDO $connection
* @var \PDOStatement $statement
* @var int $fetchHandler
* @var array $results
* @var array  $options
* @var bool $error
*/
private $sql;
private $connection;
private $statement;
private $fetchHandler = 'FetchObject';
private $result;
private $options = [];
private $error = false;


// fetch handler class name
const FH_NAME = '\\JK\\Database\\Statement\\%s';



/**
* Constructor
* @param \PDO $connection 
* @return void
*/
public function __construct(PDO $connection)
{
      $this->connection = $connection;
}


/**
* Execute query
* @param string $sql 
* @param array $params 
* @param bool $fetch [ determine if fetch results or no ]
* @return mixed
* @throws \Exception 
*/
public function execute($sql='', $params = [], $fetch = true)
{
     if(!$sql) { exit('No Query setted!'); }

     try
     {
          $this->statement = $this->connection->prepare($sql);
          // beginTransaction ...
          $this->statement->execute($params);
          // commit ...

          if($fetch)
          {
             $this->fetchModeProcess();
             $this->result = $this->record();
             return $this;
          }

    }catch(PDOException $e){
         
         // rollback ...
         $this->error = true;
         $html  = '<h4>Error Mysql: </h4>';
         $html .= '<p>' . $e->getMessage() . '</p>';
         $html .= '<h4>Last Query: </h4>';
         $html .= '<p>' . $sql . '</p>';
         echo $html;
         exit;
    }
 
}




/**
* Fetch class
* @param string $entity [class name]
* @param array $arguments
* @return 
*/
public function fetchClass($entity=null, $arguments = [])
{
    $this->fetchModeRegister('FetchClass', [
      'entity' => $entity, 
      'arguments' => $arguments
    ]);
    return $this;
}


/**
* Fetch column
* @param int $colno [number of column]
* @param array $arguments
* @return 
*/
public function fetchColumn($colno=null, $arguments = [])
{
    $this->fetchModeRegister('FetchColumn', [  
      'column' => $colno, 
      'arguments' => $arguments
    ]);
    return $this;
}


/**
* Fetch into
* @param object $object
* @param array $arguments
* @return 
*/
public function fetchInto($object=null, $arguments = [])
{
    $this->fetchModeRegister('FetchInto', [  
      'object' => $object,   
      'arguments' => $arguments
    ]);
    return $this;
}



/**
* Begin Transaction
* @return void
*/
public function transaction()
{
    $this->connection->beginTransaction(); 
}


/**
* Commit
* @return void
*/
public function commit()
{
    $this->connection->commit(); 
}


/**
* Rollback
* @return void
*/
public function rollback()
{
    $this->connection->rollBack();
}



/**
* Get results
* @return array
*/
public function results()
{
    return $this->result;
}

 
/**
* Get first result
* @return array
*/
public function first()
{
   return !empty($this->result) ? $this->result[0] : [];
}



/**
* Get result count 
* @return int
*/
public function count()
{
    return $this->statement->rowCount();
}

 
/**
* Get last insert id
* @return int
*/
public function lastID()
{
   return $this->connection->lastInsertId();
}


/**
* Get errors
* @return array
*/
public function errors()
{
   return $this->statement->errorInfo();
}


/**
 * Fetch one record
 * @param bool $one
 * @return mixed
*/
public function record($one=false)
{
    $result = $this->statement->fetchAll();
    if($one)
    {
       $result = $this->statement->fetch();
    }
    return $result;
}


/**
* To Refactoring
* Fetch mode process
* @return void
*/
private function fetchModeProcess()
{
    $object = $this->getHandler();
    call_user_func([$object, 'setMode']);
}



/**
 * Get class handler
 * @return string
*/
private function getHandler()
{
    $class = sprintf(self::FH_NAME, 
           ucfirst($this->fetchHandler)
    );
    
    if(!class_exists($class))
    {
        exit(sprintf('class <strong>%s</strong> does not exist!', $class));   
    }

    return new $class($this->statement, $this->options);
}


/**
* register fetch mode
* @param string $fetchHandler
* @param array $options
* @return void
*/
private function fetchModeRegister(
$fetchHandler = null, 
$options = []
)
{
     $this->fetchHandler = $fetchHandler; 
     $this->options = $options;
}

}