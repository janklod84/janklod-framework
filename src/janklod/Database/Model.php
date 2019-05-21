<?php 
namespace JK\Database;


use JK\ORM\{
	Query,
	QueryBuilder
};

use JK\Database\DatabaseManager;

/**
 * @package JK\Database\Model
*/ 
abstract class Model
{
    
    /**
     * @var \JK\ORM\Query $query
     * @var  \JK\ORM\QueryBuilder $builder
     * @var  array $guarded
     * @var  array $fillable
     * @var  bool  $softDelete
    */
    protected $query;
    protected $builder;


    /**
     * Constructor
     * @param string $table
     * @return void
    */
    public function __construct()
    {
        $connection = DatabaseManager::instance();
        $this->query = new Query($connection);
        $this->builder = new QueryBuilder();
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


    
    /**
     * Get values
     * @return array
    */
    public function valueQuery()
    {
        return $this->builder->values;
    }
    
}