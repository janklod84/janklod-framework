<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	  
	  /**
	   * @var string $table
	   * @var array $sql
	   * @var array $values
	  */
	  private $table  = 'no-table';
	  private $sql    = [];
	  public  $values = [];


	  /**
	   * Constructor
	   * @param string|null $table 
	   * @return void
	  */
	  public function __construct($table=null)
	  {
            $this->table = $table;
	  }
}