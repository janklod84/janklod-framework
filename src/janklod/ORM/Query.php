<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;


/**
 * @package JK\ORM\Query 
*/ 
class Query 
{
	   
/**
* @var \PDO $connection
* @var \PDOStatement $statement
* @var int $fetchHandler
* @var array $result
* @var array $options
* @var bool $error
* @var array $queries
*/
private $connection;
private $statement;
private $fetchHandler = 'FetchObject';
private $fetchMode = false;
private $options = [];
private $error = false;
private $queries = [];



// fetch handler class name
const FH_NAME = '\\JK\\ORM\\Statement\\%s';



/**
* Constructor
* @param \PDO $connection 
* @return void
*/
public function __construct(PDO $connection = null)
{
    if(is_null($connection))
    {
         exit('No connection! for : '. __CLASS__);
    }
    $this->connection = $connection;
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
    $this->fetchMode = true;
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
    $this->fetchMode = true;
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
    $this->fetchMode = true;
    return $this;
}



/**
* Begin Transaction
* @return void
*/
public function transaction()
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
 * @param string $param
 * @param int $type 
 * @return void
*/
// public function bind($param='', $type=''){}


/**
 * To Fix
 * Execute many queries
 * @param array $queries
 * @return mixed
*/
public function multi($queries = [])
{
    try
    {
        // begin transaction ...
        $this->transaction();
        foreach($queries as $sql => $values)
        {
            $this->execute($sql, $values);
        }
        // commit ...
        $this->commit();

    }catch(\PDOException $e){
        
        // rollback ...
        $this->rollback();
        exit($e->getMessage());
    }
}



/**
* Execute query
* @param string $sql 
* @param array $params 
* @return mixed
* @throws \Exception 
*/
public function execute(string $sql='', $params = [])
{
     if(!$sql) { exit('No Query sql added!'); }
     $this->statement = $this->connection->prepare($sql);

     try
     {
          // execute statement
          if($this->statement->execute($params))
          {
               $this->addQuery($sql);
          }
          
          // set fetch mode
          if($this->fetchMode)
          {
             $this->setFetchMode();
          }

          // close cursor for next query [ somme drivers need it ]
          $this->statement->closeCursor();

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

     return $this;
}


/**
 * Get all queries
 * @return array
*/
public function queries()
{
    return (new QueryPrinter($this->queries))
           ->printOut();
} 



/**
 * Fetch record
 * @param bool $type [one, 'first']
 * @param int $fetchMode
 * @return mixed
*/
public function result(
$type=false, 
int $fetchMode = null
)
{
    $results = $this->statement->fetchAll($fetchMode);
    switch($one)
    {
         case 'one':
           $result = $this->statement->fetch($fetchMode);
         break;
         case 'first':
           $result = !empty($results) ? $results[0] : [];
         break;
         default:
           $result = $results;
    }
    return $result;
}


/**
* Get result count 
* @return int
*/
public function count()
{
    return $this->statement
                ->rowCount();
}

 
/**
* Get last insert id
* @return int
*/
public function lastID()
{
   return $this->connection
               ->lastInsertId();
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


/**
* Register fetch params
* @param string $fetchHandler [ name of class ]
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


/**
* Set Fetch mode
* @return void
*/
private function setFetchMode()
{
     $class = sprintf(self::FH_NAME, 
           ucfirst($this->fetchHandler)
     );
    
     if(!class_exists($class))
     {
        exit(sprintf('class <strong>%s</strong> does not exist!', $class));   
     }

     $object = new $class($this->statement, $this->options);
     call_user_func([$object, 'setMode']);
}

}