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
* @var int $fetchHandler
* @var array $result
* @var array $options
* @var bool $error
* @var array $queries
* @var string $table
* @var string $result
* @var int $count
* @var int $lastID
* @var int $builder
*/
private $connection;
private $statement;
private $fetchHandler = 'FetchObject';
private $options = [];
private $error = false;
private $queries = [];
private $table = '';
private $result;
private $count;
private $lastID;



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
public function exec($sql)
{
    return $this->connection 
               ->exec($sql);
}


/**
* Execute query
* @param string $sql 
* @param array $params 
* @param 
* @return mixed
* @throws \Exception 
*/
public function execute(string $sql='', array $params = [])
{
     if(!$sql) { exit('No Query sql added!'); }
     $this->statement = $this->connection->prepare($sql);

     try
     {
         
          // begin transaction ...
          $this->transaction();

          // execute statement
          if($this->statement->execute($params))
          {
               $this->addQuery($sql);

               // set fetch mode
               $this->setFetchMode();

               // get results
               $this->result = $this->statement->fetchAll();

               // rows count
               $this->count  = $this->statement->rowCount();

               // last insert id
               $this->lastID = $this->connection->lastInsertId();
          
          }
          
          // commit
          $this->commit();

          
     }catch(PDOException $e){
         
         // rollback ...
         $this->rollback();
         $this->error = true;
         $html  = '<h4>Error Mysql: </h4>';
         $html .= '<p>' . $e->getMessage() . '</p>';
         $html .= '<h4>Last Query: </h4>';
         $html .= '<p>' . $sql . '</p>';
         echo $html;

         throw new \Exception($e->getMessage());
         
         // exit;
     }

     return $this;
}



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
 * Get all queries
 * @return array
*/
public function queries()
{
   debug($this->queries);
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
     die($this->fetchHandler);
     $object = new $class($this->statement, $this->options);
     call_user_func([$object, 'setMode']);
}

}