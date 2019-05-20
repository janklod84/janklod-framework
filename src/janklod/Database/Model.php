<?php 
namespace JK\Database;


use JK\Database\ORM\QueryBuilder;
use JK\Database\Statement\Query;
use \PDO;

/**
 * @package JK\Database\Model
*/ 
abstract class Model
{
	   
	/**
     * @var \JK\Database\Query $query
     * @var \JK\Database\ORM\QueryBuilder $queryBuilder
    */
    protected $query;
    protected $queryBuilder;


    /**
     * Constructor
     * @return void
    */
    public function __construct()
    {
        $this->query = new Query();
        $this->queryBuilder = new QueryBuilder();
        if(method_exists($this, 'before'))
        {
            $this->before();
        }
        
    }

}