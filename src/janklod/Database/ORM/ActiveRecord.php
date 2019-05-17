<?php 
namespace JK\Database\ORM;


use JK\Database\DatabaseManager;
use JK\Database\Statement\Query;


/**
 * @package JK\Database\ORM\ActiveRecord 
*/ 
trait ActiveRecord
{
	   
    /**
     * @var \JK\Database\Query $query
     * @var  \JK\Database\ORM\QueryBuilder $queryBuilder
     * @var  array $guarded
     * @var  array $fillable
     * @var  bool  $softDelete
    */
    protected $query;
    protected $queryBuilder;
    protected $guarded  = [];
    protected $fillable = [];
    protected $softDelete = false;
       

    /**
     * Constructor
     * @return void
    */
    public function __construct()
    {
    	$db = DatabaseManager::instance();
        $this->query = new Query($db);
        $this->query->fetchClass($this->entity());
        $this->queryBuilder = new QueryBuilder($this->table);
    }

    
    /**
     * Get name of table
     * @return string
    */
    public function getTable(): string
    {
        return $this->table;
    }

    
    /**
     * Make Query
     * @param string $sql 
     * @param array $params 
     * @param bool $fetch 
     * @return mixed
    */
    protected function execute($sql='', $params = [], $fetch = true)
    {
          return $this->query->execute($sql, $params, $fetch);
    }

    
    /**
     * Make Query
     * @param string $sql 
     * @return string
    */
    public function makeQuery($sql = '')
    {
        return $sql ?: 'SELECT * FROM '. $this->table;
    }


    /**
     * Get all results
     * @return array
    */
    public function findAll()
    {
       $sql = 'SELECT * FROM '. $this->table;
       return $this->execute($sql)->results();
    }

    
    /**
     * Get fist result
     * @return array
    */
    public function findFisrt()
    {
        $sql = 'SELECT * FROM '. $this->table;
        return $this->execute($sql)->first();
    }


    /**
     * Get fist result
     * @return array
    */
    public function findById()
    {
        $sql = 'SELECT * FROM '. $this->table .' WHERE id = ? LIMIT 1';
        return $this->execute($sql, [$this->id])->results();
    }


    /**
     * Save data
     * @return mixed
    */
    public function save()
    {
        if(property_exists($this, 'id') && isset($this->id))
        {
            echo 'UPDATE' . $this->id;
        }else{
            echo 'INSERT';
        }
    }


    /**
     * Get entity
     * @return string
    */
    private function entity()
    {
        if(property_exists($this, 'entity') && $this->entity !== '')
        {
            return $this->entity;
        }
        return get_class($this);
    }

    
}