<?php 
namespace JK\Database;


use \PDO;
use \Exception;


/**
 * @package JK\Database\Query 
*/ 
class Query 
{
	   
	   /**
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
	   private $connection;
	   private $statement;
     private $fetchMode = PDO::FETCH_OBJ;
     private $className = \stdClass::class;
     private $options = [];
     private $result;
     private $count;
     private $error = false;
     private $lastId;



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
      * Set fetch mode
      * @param int $fetchMode
      * @param string $className [class name: \app\models\User]
      * @param array $options
      * @return self
     */
     public function fetchStyle(
      $fetchMode = PDO::FETCH_OBJ, 
      $className = null, 
      $options = []
     )
     {
           $this->fetchMode = $fetchMode; 
           $this->className = $className;
           $this->options   = $options;
           return $this;
     }

     

     /**
      * Execute query
      * @param string $sql 
      * @param array $params 
      * @return mixed
      * @throws \Exception 
     */
	   public function execute($sql, $params = [])
	   {
          $this->statement = $this->connection->prepare($sql);
          $this->connection->beginTransaction(); 
          if(!$this->statement->execute($params))
          {
               $this->error = true;
               $this->connection->rollBack();
               throw new Exception('Query error!');
          }
          $this->connection->commit(); 
          $this->fetchModeProcess();
          $this->result = $this->fetch();
          $this->count  = $this->statement->rowCount();
          $this->lastId = $this->connection->lastInsertId();
          return $this;
	   }

     
     /**
      * Get result
      * @param bool $one ['one', 'all', 'column']
      * @return self
     */
     public function fetch($one = false)
     {
         if($one)
           return $this->statement->fetch();
         else
           return $this->statement->fetchAll();
     }

  
     /**
      * Get results
      * @return mixed
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
         $result = [];
         if(!empty($this->result))
         {
            $result = $this->result[0];
         }
         return $result;
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
         return $this->lastId;
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
      * Fetch mode process
      * @return void
     */
     private function fetchModeProcess()
     {
           if(
            $this->className !== \stdClass::class 
            && $this->fetchMode === PDO::FETCH_CLASS
           )
           {
                $this->statement->setFetchMode($this->fetchMode, $this->className);

           }elseif($this->fetchMode === PDO::FETCH_COLUMN){
                
                $columnName = $this->getOption('column');
                $this->statement->setFetchMode($this->fetchMode, $columnName);

           }else{

                $this->statement->setFetchMode($this->fetchMode);
           }
     }

     
     /**
      * Get option
      * @param string $key 
      * @return 
     */
     private function getOption($key)
     {
          if(empty($this->options[$key]))
          {
              throw new Exception("Key {$key} does not exist in options", 404);
          }
          return $this->options[$key];
     }


}