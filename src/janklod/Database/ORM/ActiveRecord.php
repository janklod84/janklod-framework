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
        // $this->query->fetchClass($this->entity());
        $this->queryBuilder = new QueryBuilder();
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
     * @return string
    */
    protected function makeSelect()
    {
         return $this->queryBuilder
                     ->select()
                     ->from($this->table);
    }


    /**
     * Get all results
     * @return array
    */
    public function findAll()
    {
       $sql = $this->makeSelect()->sql();
       return $this->query->execute($sql)->results();
    }

    
    /**
     * Get fist result
     * @return array
    */
    public function findFisrt()
    {
        $sql = $this->makeSelect()->sql();
        return $this->query->execute($sql)->first();
    }


    /**
     * Get fist result
     * @return array
    */
    public function findById()
    {
        $sql = $this->makeSelect()
                    ->where('id', $this->id)
                    ->limit(1)
                    ->sql();
        return $this->query
                    ->execute($sql, $this->queryBuilder->values)
                    ->results();
    }

    
    /**
     * Insert data into database
     * @param array $params 
     * @return 
     */
    public function insert($params = [])
    {
         $sql = $this->queryBuilder
                     ->insert($this->table)
                     ->set($params)
                     ->sql();
         return $this->query
                     ->execute($sql, $this->queryBuilder->values, false);
    }


    /**
     * Update data into database
     * @param array $params 
     * @return 
    */
    public function update($params = [])
    {
         $sql = $this->queryBuilder
                     ->update($this->table)
                     ->set($params)
                     ->where('id', $this->id)
                     ->sql();
         return $this->query
                     ->execute($sql, $this->queryBuilder->values, false);
    }


    /**
     * Save data
     * @return mixed
    */
    public function save()
    {
        $save = null;
        if(property_exists($this, 'id') && isset($this->id))
        {
            $save = $this->update([
                'username' => 'BrownUpdated2'
            ]);

        }else{
            
            $save = $this->insert([
                'username' => 'BrownNew', 
                'password' => 'PwQwerty', 
                'role' => '1'
            ]);
        }
        return $save;
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