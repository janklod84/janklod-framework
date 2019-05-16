<?php 
namespace JK\Database\ORM;


use JK\Database\{
    DatabaseManager,
    Query
};
use JK\Database\ORM\QueryBuilder;
use \PDO;
use \Exception;


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
        $this->query->fetchStyle(PDO::FETCH_CLASS, $this->getEntity());
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
     * Get all results
     * @return array
    */
    public function all()
    {
        return $this->query
                    ->execute('SELECT * FROM '. $this->table)
                    ->results();
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
    private function getEntity()
    {
        if(property_exists($this, 'entity') && $this->entity !== '')
        {
            return $this->entity;
        }
        return get_class($this);
    }

    
}