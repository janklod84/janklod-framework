<?php 
namespace JK\Database\Statement;


use \PDO;
use \Exception;


/**
 * @package JK\Database\Statement\Query 
*/ 
class Query 
{
	   
/**
* @var string $sql
* @var \PDO $connection
* @var \PDOStatement $statement
* @var int $fetchMode
* @var string $className
* @var array  $options
* @var mixed $result 
* @var int $count
* @var bool $error
* @var int $lastId  Last insert id
*/
private $sql;
private $connection;
private $statement;
private $fetchHandler;
private $options = [];
private $result;
private $count;
private $error = false;
private $lastId;


// fetch handler prefix
const FH_PREFIX = '\\JK\\Database\\Statement\\%s';



/**
* Constructor
* @param PDO $connection 
* @return void
*/
public function __construct(PDO $connection)
{
    $this->connection = $connection;
}


/**
* Prepare query
* @param string $sql 
* @return self
*/
public function prepare($sql = '')
{
   if($sql !== '')
   {
       $this->statement = $this->connection->prepare($sql);
   }

   return $this;
}



/**
* Fetch class
* @param string $entity [class name]
* @param array  $arguments
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
* @return 
*/
public function fetchColumn($colno=null)
{
    $this->fetchModeRegister('FetchColumn', [  
      'column' => $colno
    ]);
    return $this;
}


/**
* Fetch into
* @param object $object
* @return 
*/
public function fetchInto($object=null)
{
    $this->fetchModeRegister('FetchInto', [  
      'object' => $object
    ]);
    return $this;
}


/**
* Fetch mixed
* @param string $mode 
* @param array $options [$options['mode'] = PDO::FETCH_CLASS|PDO::FETCH_OBJ]
* @return self
*/
public function fetchComplex($options = [])
{
     $this->fetchModeRegister('FetchComplex', $options);
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
* Execute query
* @param string $sql 
* @param array $params 
* @param bool $fetch [ determine if fetch results or no ]
* @return mixed
* @throws \Exception 
*/
public function execute($sql, $params = [], $fetch = true)
{
    if(empty($this->statement))
    {
        $this->statement = $this->connection->prepare($sql);
    }

    // begin transaction
    if(!$this->statement->execute($params))
    {
         $this->error = true;
         // rollback
         die('Query : ['. $sql . ']');
    }
    // commit

    if($fetch)
    {
        $this->fetchModeProcess();
        return $this;
    }
}


/**
* Get results
* @return mixed
*/
public function results()
{
    return $this->fetch();
}

 
/**
* Get first result
* @return array
*/
public function first()
{
   return $this->fetch(true);
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
* Get error
* @return mixed
*/
public function error()
{
   return $this->error;
}


/**
* To Refactoring
* Fetch mode process
* @return void
*/
private function fetchModeProcess()
{
    if(empty($this->options))
    {
         $this->fetchHandler = 'FetchObject';
    }

    $class = sprintf(self::FH_PREFIX, 
           ucfirst($this->fetchHandler)
    );

    $object = new $class($this->statement, $this->options);
    call_user_func([$object, 'setMode']);
}


/**
* Get result
* @param bool $one
* @return self
*/
private function fetch($one = false)
{
   $result = $this->statement->fetchAll();
   if($one && !empty($result))
   {
      $result = $result[0];
   }
   return $result ?? [];
}

/**
* register fetch mode
* @param string $fetchHandler
* @param array $options
* @return self
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