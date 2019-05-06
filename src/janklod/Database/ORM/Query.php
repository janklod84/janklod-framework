<?php 
namespace JK\Database\ORM;


use \PDO;
use JK\Database\DatabaseManager;


/**
 * @package JK\Database\ORM\Query 
*/ 
class Query
{
	   
	   /**
	    * @var \PDO $connect
	    * @var string $sql
	    * @var \PDOStatement $stmt
	    * @var array $params
	    * @var mixed $fetchStyle
	    * @var array $result
	    * @var int   $count
	    * @var bool  $error
	    * @var int   $lastInsertID
	   */
     private $connect;
	   private $sql;
	   private $stmt;
	   private $params = [];
	   private $fetchStyle = PDO::FETCH_OBJ;
	   private $result;
	   private $count;
	   private $error = false;
	   private $lastInsertID;

       
     /**
 	    * Execute Query
 	    * @param string $sql
 	    * @param array $params
 	    * @param bool $class
 	    * @return self
	   */
	   public function execute($sql, $params = [], $class = false): self
	   {
             if($this->stmt = DatabaseManager::connect()->prepare($sql))
             {
             	  if($this->stmt->execute($params))
             	  {
             	  	   if($class && $this->fetchStyle === PDO::FETCH_CLASS)
             	  	   {
             	  	   	    $this->result = $this->stmt->fetchAll($this->fetchStyle, $class);

             	  	   }else{

                           $this->result = $this->stmt->fetchAll($this->fetchStyle);
             	  	   }

             	  	   $this->count = $this->stmt->rowCount();
             	  	   $this->lastInsertID = DatabaseManager::connect()->lastInsertId();

             	  }else{

             	  	  $this->error = false;
             	  }
             }

             return $this;
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
	   	   return !empty($this->result) ? $this->result[0] : [];
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
      * Get last insert ID
      * @return int
     */
	   public function lastID()
	   {
         return $this->lastInsertID;
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
      * Get columns table
      * @param string $table 
      * @return array
     */
     public function getColumns($table)
     {
     	   return $this->execute(sprintf('SHOW COLUMNS FROM `%s`', $table))
     	               ->results();
     }


}