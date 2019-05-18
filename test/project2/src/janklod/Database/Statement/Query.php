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
* @var int $fetchHandler
* @var string $className
* @var array  $options
* @var bool $error
*/
private $sql;
private $connection;
private $statement;
private $fetchHandler;
private $options = [];
private $error = false;


// fetch handler class name
const FH_NAME = '\\JK\\Database\\Statement\\%s';



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
    
    echo $sql .'<br>';
    debug($params);
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
* @return mixed
*/
public function results()
{
    return $this->record();
}

 
/**
* Get first result
* @return array
*/
public function first()
{
   return $this->record(true);
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
 * Fetch one record
 * @param string $mode 
 * @return mixed
*/
public function record($one=false)
{
    $result = $this->statement->fetchAll();
    if($one && !empty($result))
    {
       // $this->statement->fetch()
       $result = $result[0]; 
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
    $object = $this->getProcessObject();
    call_user_func([$object, 'setMode']);
}



/**
 * Get class name
 * @return string
*/
private function getProcessObject()
{
    if(!$this->options && !$this->fetchHandler)
    {
         $this->fetchHandler = 'FetchObject';
    }

    $class = sprintf(self::FH_NAME, 
           ucfirst($this->fetchHandler)
    );

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