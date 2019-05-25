<?php 
namespace JK\Database;

use JK\ORM\QQ;

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
    QQ::addTable($this->table);
    if($this->entity)
    {
         QQ::fetchClass(get_class($this));
    }
 
    if($id){ $this->id = $id; }
    if(method_exists($this, 'before'))
    {
         $this->before();
    }
}

/**
 * Do some action before next actions actions
 * Do some action before storage data
 * @return void
*/
protected function before(){}
protected function beforeSave(){}


/**
 * Do some action after all actions
 * Do some action after storage data
 * @return void
*/
protected function after(){}
protected function afterSave(){}



/**
 * Get name of table
 * @return string
*/
public function getTable(): string
{
    return QQ::getTable(true);
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
    return QQ::getTable()->all();
}


/**
 * Find record by id
 * @return array
*/
public function findById()
{
    return QQ::getTable()->read($this->id);
}



/**
 * Find record by field by defaut column is id
 * @param string $field 
 * @param string $value 
 * @return array
*/
public function findBy($value=null, $field='id')
{
     return QQ::getTable()->read($value, $field);
}


/**
 * Insert data into database
 * @param array $params 
 * @return 
*/
public function insert($params = [])
{
     return QQ::getTable()->create($params);
}


/**
 * Update data into database by defaut column is id
 * @param array $params 
 * @return 
*/
public function update($params = [])
{
    return QQ::getTable()->update($params, $this->id);
}


/**
 * Delete one record from database
 * @param int $id
 * @return 
*/
public function delete($id=null)
{
   return QQ::getTable()->delete($this->id);
}



/**
 * Save data
 * @return mixed
*/
public function save()
{
    $params = [];
    if(property_exists($this, 'id') && isset($this->id))
    {
        $params = ['username' => 'BrownUpdated2'];
        return $this->update($params);

    }else{
        $params = [
             'username' => 'BrownNew', 
            'password' => 'PwQwerty', 
            'role' => '1'
        ];
        return $this->insert($params);
    }
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