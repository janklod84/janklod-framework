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
    
}