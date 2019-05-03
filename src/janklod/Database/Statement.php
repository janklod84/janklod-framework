<?php 
namespace JK\Database;


use \PDO;

/**
 * @package JK\Database\Statement 
*/ 
class Statement 
{
	   
	   /**
	    * @var \PDO $connection
	   */
	   private $connection;


	   /**
	    * Constructor
	    * @param PDO $connection 
	    * @return void
	   */
	   public function __construct(PDO $connection)
	   {
             $this->connection = $connection;
	   }
}