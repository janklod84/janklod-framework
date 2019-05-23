<?php 
namespace JK\Database;

use JK\ORM\Query;

/**
 * @package JK\Database\ActiveRecord 
*/ 
class ActiveRecord extends Model
{


/**
 * @var  array $guarded
 * @var  array $fillable
 * @var  bool  $softDelete
 * @var  bool $entity
 * @var  bool $softDelete
 * @var  string $table
 * @var  \JK\ORM\Query $query
 * @var  \JK\Database\DatabaseManager $connection
 * @var  int $id
*/
protected $guarded  = [];
protected $fillable = [];
protected $entity   = true;
protected $softDelete = false;
protected $table;
protected $id;



/**
 * Constructor
 * @param int $id
 * @return void
*/
public function __construct($id=null)
{
    parent::__construct();
    $this->query->table($this->table);
    if($this->entity)
    {
         $this->query->fetchClass(get_class($this));
    }
    if($id){ $this->id = $id; }
    if(method_exists($this, 'before'))
    {
         $this->before();
    }
}

/**
 * Do some action before others actions
 * @return void
*/
protected function before(){}


/**
 * Get name of table
 * @return string
*/
public function getTable(): string
{
    return $this->table;
}


/**
 * 
 * @return 
*/
public function columnMap()
{

}



/**
 * Find all records
 * @return array
*/
public function findAll()
{
    return $this->query
                ->all();
}


/**
 * Find record by id
 * @return array
*/
public function findById()
{
    return $this->query
                ->read($this->id);
}



/**
 * Find record by field by defaut column is id
 * @param string $field 
 * @param string $value 
 * @return array
*/
public function findBy($value=null, $field='id')
{
     return $this->query
                 ->read($value, $field);
}


/**
 * Insert data into database
 * @param array $params 
 * @return 
*/
public function insert($params = [])
{
     return $this->query
                 ->create($params);
}


/**
 * Update data into database by defaut column is id
 * @param array $params 
 * @return 
*/
public function update($params = [])
{
    return $this->query
                ->update($params, $this->id);
}


/**
 * Delete one record from database
 * @param int $id
 * @return 
*/
public function delete($id=null)
{
   return $this->query
               ->delete($this->id);
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
 * Determine if has new record or not
 * @return bool
*/
protected function isNew(): bool
{
    return $this->has('id');
}


/**
 * Determine if has param
 * @param string $type
 * @return bool
*/
protected function has($type='xxx'): bool
{
      switch($type)
      {
           case 'entity':
             return property_exists($this, 'entity') 
                    && $this->entity;
           break;
           case 'id':
            return property_exists($this, 'id') 
                    && isset($this->id);
           break;
      }
}

    
}