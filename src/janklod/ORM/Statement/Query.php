<?php 
namespace JK\ORM\Statement;


use \PDO;
use \PDOException;


/**
 * @package JK\ORM\Statement\Query 
*/ 
class Query 
{
	   
/**
* @var \PDO $connection
* @var \PDOStatement $statement
* @var string $fetchHandler
* @var bool $error
* @var array $queries
* @var string $table
* @var string $result
* @var int $count
* @var int $lastID
* @var array $arguments
*/
private $connection;
private $statement;
private $fetchHandler = 'FetchObject';
private $error = false;
private $executed  = false;
private $queries = [];
private $table = '';
private $result;
private $count;
private $lastID;
private $arguments = [];


// fetch handler class name
const FH_NAME = '\\JK\\ORM\\Statement\\Fetch\\%s';



/**
* Constructor
* @param \PDO $connection 
* @param string $table
* @return void
*/
public function __construct(PDO $connection = null)
{
    if(!is_null($connection))
    {
        $this->connection = $connection;
    }
}


/**
 * Execute simple query
 * $this->exec('DELETE FROM table ')
 * @param string $sql 
 * @return bool
 */
public function exec($sql='')
{
    return $this->connection 
               ->exec($sql);
}


/**
* Fetch class
* @param string $entity [class name]
* @param array $arguments ['mode' => 'PDO::FETCH_CLASS|PDO::FETCH_OBJ..']
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
* @param array $arguments ['mode' => 'PDO::FETCH_COLUMN|PDO::FETCH_OBJ..']
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
* @param array $arguments ['mode' => 'PDO::FETCH_INTO|PDO::FETCH_OBJ..']
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
* Execute query
* @param string $sql 
* @param array $params 
* @return mixed
* @throws \Exception 
*/
public function execute(string $sql, array $params = [])
{
  try
  {
     $this->statement = $this->connection->prepare($sql);

     try
     {
          // begin transaction ...
          /* $this->beginTransaction(); */

          // execute statement
          if($this->statement->execute($params))
          {
               $this->addQuery($sql);
               $this->executed = true;
          }
         
          // set fetch mode
           $this->setFetchMode();

           // get results
           $this->result = $this->statement->fetchAll();

           // rows count
           $this->count  = $this->statement->rowCount();

          // last insert id
           $this->lastID = $this->connection->lastInsertId();
           
           // commit [always to the end]
           /* $this->commit(); */

     }catch(PDOException $e){
         
         // rollback ...
         /* $this->rollback(); */

         $this->error = true;
         $html  = '<h4>Error Mysql: </h4>';
         $html .= '<p>' . $e->getMessage() . '</p>';
         $html .= '<h4>Last Query: </h4>';
         $html .= '<p>' . $sql . '</p>';
         echo $html;

         throw new QueryException($e->getMessage());
         
         // exit;
     }

    }catch(PDOException $e){

         throw new StatementException($e->getMessage());
    }

    return $this;
}


/**
 * return status execution
 * @return bool
*/
public function executed(): bool
{
   return $this->executed;
}

/**
* Set Fetch mode
* @return void
*/
public function setFetchMode()
{
    $class = sprintf(self::FH_NAME, ucfirst($this->fetchHandler));
    if(!class_exists($class))
    {
        exit(sprintf('class <strong>%s</strong> does not exist!', $class));   
    } 
    $obj = new $class($this->statement, $this->arguments);
    call_user_func([$obj, 'setMode']);
}


/**
* Register fetch params
* @param string $fetchHandler [ name of class ]
* @param array $arguments
* @return void
*/
private function fetchModeRegister(
$fetchHandler = null, 
$arguments = []
)
{
     $this->fetchHandler = $fetchHandler; 
     $this->arguments    = $arguments;
}



/**
* Begin Transaction
* @return void
*/
public function beginTransaction()
{
    return $this->connection->beginTransaction(); 
}


/**
* Commit
* @return void
*/
public function commit()
{
    return $this->connection->commit(); 
}


/**
* Rollback
* @return void
*/
public function rollback()
{
    return $this->connection->rollBack();
}


/**
 * Bind param or value
 * @param mixed $param
 * @param mixed $value
 * @param int $type 
 * @return void
*/
public function bind($param, $value, $type=0){}




/**
 * Close cursor
 * close cursor for next query [ somme drivers need it ]
 * @return 
*/
public function close()
{
    return $this->statement->closeCursor();
}


/**
 * Get all executed queries
 * @return array
*/
public function queries()
{
    return $this->queries;
} 



/**
 * Fetch all records
 * @return mixed
*/
public function results()
{
   return $this->result;
}



/**
 * Get first record
 * @return array
*/
public function first()
{
    return ! empty($this->result) ? $this->result[0] : [];
}


/**
* Get result count 
* @return int
*/
public function count()
{
    return $this->count;
}

 
/**
* Get last insert id
* @return int
*/
public function lastID()
{
   return $this->lastID;
}


/**
* Determine error status
* @return bool
*/
public function error(): bool
{
   return $this->error;
}


/**
 * Get info errors
 * @return array
*/
public function errors()
{
    return $this->statement
                ->errorInfo();
}



/**
 * Add Query
 * @param string $sql [type string very important ]
 * @return array
*/
private function addQuery($sql)
{
     array_push($this->queries, $sql);
}


}