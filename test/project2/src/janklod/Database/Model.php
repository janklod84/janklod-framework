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
     * @var  string $table
     * @var  array  $guarded
     * @var  array  $fillable
     * @var  bool   $softDelete
    */
    protected $query;
    protected $queryBuilder;


    /**
     * Constructor
     * @return void
    */
    public function __construct()
    {
        $db = DatabaseManager::instance();
        $this->query = new Query($db);
        $this->queryBuilder = new QueryBuilder();
        if(method_exists($this, 'before'))
        {
            $this->before();
        }
        
    }


    /**
     * Make Query
     * @param string $sql 
     * @param array $params 
     * @param bool $fetch 
     * @return mixed
    */
    protected function execute($sql, $params = [], $fetch = true)
    {
          return $this->query->execute($sql, $params, $fetch);
    }

}