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
* @var string $sql
* @var \PDO $connection
* @var \PDOStatement $statement
* @var int $fetchHandler
* @var array $result
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
private $queries = [];
private $increment = 0;


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
* Execute query
* @param string $sql 
* @param array $params 
* @param bool $fetch [ determine if fetch results or no ]
* @return mixed
* @throws \Exception 
*/
public function execute(string $sql='', $params = [], $fetch = true)
{
     if(!$sql) { exit('No Query sql added!'); }
     try
     {
          $this->statement = $this->connection->prepare($sql);
          // beginTransaction ...
          if($this->statement->execute($params))
          {
                 $this->addQuery($sql);
                 $this->increment++;
          }
          // commit ...

          if($fetch)
          {
             $this->setFetchMode();
             $this->result = $this->record();
             return $this;
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
    
}


/**
 * Add Query
 * @param string $sql [type string very important ]
 * @return array
*/
public function addQuery($sql)
{
     array_push($this->queries, $sql);
}


/**
 * Add one time query
 * @param string $sql 
 * @return void
*/
public function addOneTime($sql)
{
    if(!in_array($sql, $this->queries))
    {
        $this->addQuery($sql);
    }
}


/**
 * Get all queries
 * @return array
*/
public function queries()
{
     $html = '<strong>Count executed queries : </strong>'.$this->increment;
     $html .= '<br/>';
     if(!empty($this->queries))
     {
         $i = 1;
         $html .= '<strong>Currents queries : </strong>';
         foreach($this->queries as $query)
         {
             $html .= '<div>'. $i.'--- '. $query . '</div>';
             $i++;
         }
     }
     echo $html;
} 

/**
 * Fetch record
 * @param bool $one
 * @return mixed
*/
protected function record($one=false)
{
    $result = $this->statement->fetchAll();
    if($one)
    {
       $result = $this->statement->fetch();
    }
    return $result;
}




/**
 * To Fix
 * Execute many queries
 * @param array $queries
 * @return mixed
*/
public function multiple($queries = [])
{
    // ...
    try
    {
        $this->transaction();
        foreach($queries as $sql => $values)
        {
            $this->execute($sql, $values, false);
        }
        $this->commit();

    }catch(\PDOException $e){

        $this->rollback();
        exit($e->getMessage());
    }
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
 * Fetch one record
 * @return array
*/
public function fetchOne()
{
    $this->result = [];
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
* Get errors
* @return array
*/
public function errors()
{
   return $this->statement->errorInfo();
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

}