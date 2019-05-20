<?php 
namespace JK\Database\ORM;

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
        $this->query = new Query();
        $this->entity();
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
     * Get all results
     * @return array
    */
    public function findAll()
    {
       return $this->makeSelect()->results();
    }

    
    /**
     * Get fist result
     * @return array
    */
    public function findFisrt()
    {
        return $this->makeSelect()->first();
    }


    /**
     * Get fist result
     * @return array
    */
    public function findById()
    {
        $sql = $this->makeSelect()
                    ->where('id', $this->id)
                    ->limit(1);
        return $this->query
                    ->execute($sql, $this->queryBuilder->values)
                    ->results();
    }

    
    /**
     * Find record by field
     * @param string $field 
     * @param string $value 
     * @return array
    */
    public function findBy($field, $value)
    {
         $sql = $this->makeSelect()
                     ->where($field, $value);
        return $this->query 
                    ->execute($sql, $this->queryBuilder->values)
                    ->results();
    }


    /**
     * Save data
     * @return mixed
    */
    public function save()
    {
        $this->joinTest();
        /*
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
        */
    }
   
    protected function orderByTest()
    {
          $sql = $this->queryBuilder
                      ->orderBy('order1, order2', false)
                      ->orderBy('order3, order4')
                       ->orderBy('status, username')
                       ->orderBy('country', 'DESC');
         echo $sql;
    }
    
    /**
     * Join test
     * @return void
    */
    protected function joinTest()
    {
         /*
         $sql = $this->queryBuilder
                     ->select('u.username', 'u.password')
                     ->from($this->table, 'u')
                     ->join('orders', 'u.order_id = orders.id')
                     ->where('id', 3)
                     ->where('username', 'Brown')
                     ->or('test', 'Test2')
                     ->conditions('my = ?', 'd', 'LIKE')
                     ->orderBy('status')
                     ->orderBy('country', 'DESC');
                     // ->join('orders', 'u.order_id = orders.id', 'left');
                     // ->join('orders', 'u.order_id = orders.id', 'full');
         */
        // debug($this->queryBuilder->values);
        // echo $sql;
    }


    /**
     * Make Select Query
     * @return QueryBuilder
    */
    protected function makeSelect()
    {
         $sql = $this->queryBuilder
                     ->select()
                     ->from($this->table);
        return $this->query->execute($sql);
    }


    /**
     * Insert data into database
     * @param array $params 
     * @return 
     */
    protected function insert($params = [])
    {
         $sql = $this->queryBuilder
                     ->insert($this->table)
                     ->set($params);

         return $this->query
                     ->execute($sql, $this->queryBuilder->values, false);
    }


    /**
     * Update data into database
     * @param array $params 
     * @return 
    */
    protected function update($params = [])
    {
         $sql = $this->queryBuilder
                     ->update($this->table)
                     ->set($params)
                     ->where('id', $this->id);

         return $this->query
                     ->execute($sql, $this->queryBuilder->values, false);
    }

    
    /**
     * Determine if has new record or not
     * @return bool
    */
    protected function isNew()
    {
        return property_exists($this, 'id') 
               && isset($this->id);
    }



    /**
     * Get entity
     * @return string
    */
    protected function entity()
    {
        $entity = get_class($this);
        if(property_exists($this, 'entity') && $this->entity !== '')
        {
            $entity = $this->entity;
        }
       
       // $this->query->fetchClass($entity);
    }

    
    /**
     * Get Entity
     * @return string
    */
    public function getEntity()
    {
        return $this->entity;
    }

    
}