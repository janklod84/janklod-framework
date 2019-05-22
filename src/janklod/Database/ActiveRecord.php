<?php 
namespace JK\Database;

/*
use JK\ORM\{
	Query,
	QueryBuilder
};

use JK\Database\DatabaseManager;
*/

use JK\Database\Records\{
    Select,
    Insert,
    Update 
};


/**
 * @package JK\Database\ActiveRecord 
*/ 
class ActiveRecord
{
	   
    /**
     * @var  array $guarded
     * @var  array $fillable
     * @var  bool  $softDelete
    */
    protected $guarded  = [];
    protected $fillable = [];
    protected $softDelete = false;
       

    /**
     * Constructor
     * @return void
    */
    public function __construct()
    {
       // TO Implements
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
     * Get all records
     * @return array
    */
    public function findAll()
    {
        return (new Select($this->table))
               ->all();
    }


    /**
     * Get record by id
     * @return array
    */
    public function findById()
    {
        return (new Select($this->table))
               ->where('id', $this->id);
    }


    
    /**
     * Find record by field
     * @param string $field 
     * @param string $value 
     * @return array
    */
    public function findBy($field, $value)
    {
         return (new Select($this->table))
               ->where($field, $value);
    }


    /**
     * Insert data into database
     * @param array $params 
     * @return 
    */
    public function insert($params = [])
    {
         return (new Insert($this->table))
                ->data($params);
    }


    /**
     * Update data into database
     * @param array $params 
     * @return 
    */
    public function update($params = [])
    {
         /*
         $sql = $this->queryBuilder
                     ->update($this->table)
                     ->set($params)
                     ->where('id', $this->id);

         return $this->query
                     ->execute($sql, $this->queryBuilder->values, false);
        */
    }


    /**
     * Save data
     * @return mixed
    */
    public function save()
    {
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