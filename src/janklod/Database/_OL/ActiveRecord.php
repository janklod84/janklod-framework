<?php 
namespace JK\Database;

 

use JK\Database\Records\ 
{
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
protected $entity = false;
protected $softDelete = false;
protected $table = 'no-table';
protected $id;
   

/**
 * Constructor
 * @return void
*/
public function __construct($id=null)
{
     if($this->has('entity')) 
     {
         $entity = get_class($this); 
         (new FetchMode())->entity($entity);
     }
     
     if(!is_null($id))
     {
         $this->id = $id;
     }
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
     return (new Insert($this->table, $params))
            ->data();
}


/**
 * Update data into database
 * @param array $params 
 * @return 
*/
public function update($params = [])
{
    return (new Update($this->table, $params))
           ->where('id', $this->id);
}


/**
 * Update data into database
 * @param array $params 
 * @return 
*/
public function delete($id=null)
{
    // return (new Delete($this->table))
    //        ->where('id', $this->id);
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
                    && $this->entity !== '';
           break;
           case 'id':
            return property_exists($this, 'id') 
                    && isset($this->id);
           break;
      }
}

    
}