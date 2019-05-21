<?php 
namespace JK\Database\Records;


use JK\ORM\{
	Query,
	QueryBuilder
};

use JK\Database\DatabaseManager;

/**
 * @package JK\Database\Records\CustomRecord 
*/ 
abstract class CustomRecord 
{
   
   /**
     * @var \JK\ORM\Query $query
     * @var  \JK\ORM\QueryBuilder $queryBuilder
     * @var  array $guarded
     * @var  array $fillable
     * @var  bool  $softDelete
    */
    protected $query;
    protected $queryBuilder;
    protected $table;


	/**
     * Constructor
     * @param string $table
     * @return void
    */
    public function __construct($table = null)
    {
		$connection = DatabaseManager::instance();
        $this->query = new Query($connection);
        $this->queryBuilder = new QueryBuilder();
        $this->table = $table;
    }


    /**
     * Execute Query
     * @param string $sql 
     * @param array $params 
     * @param bool $fetch 
     * @return Query
     */
    protected function execute(
    $sql='', 
    $params = [], 
    $fetch = true)
    {
         return $this->query->execute($sql, $params, $fetch);
    }

}