<?php 
namespace JK\Database;

use JK\ORM\Q;

/**
 * @package JK\Database\ActiveRecord 
*/ 
class ActiveRecord extends Model
{


/**
 * @var  array $guarded
 * @var  array $fillable
 * @var  bool  $softDelete
 * @var  string $table
 * @var  int $id
 * @var  \JK\Container\ContainerInterface $app
*/
protected $guarded  = [];
protected $fillable = [];
protected $softDelete = false;
protected $table;
protected $id;
protected $app;


/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app)
{
    parent::__construct($app);
    $this->app = $app;
    Q::fetchClass($this->model);
    $this->app->load->call($this, 'before');
}


/**
 * Do some action before next actions actions
 * Do some action before storage data
 * @return void
*/
public function before(){}
protected function beforeSave(){}


/**
 * Do some action after all actions
 * Do some action after storage data
 * @return void
*/
public function after(){}
protected function afterSave(){}



/**
 * Get name of table
 * @return string
*/
public function getTable(): string
{
    return Q::getTable(true);
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
    return Q::getTable()->all();
}


/**
 * Find record by id
 * @return array
*/
public function findById()
{
    return Q::getTable()->read($this->id);
}



/**
 * Find record by field by defaut column is id
 * @param string $field 
 * @param string $value 
 * @return array
*/
public function findBy($value=null, $field='id')
{
     return Q::getTable()->read($value, $field);
}


/**
 * Insert data into database
 * @param array $params 
 * @return 
*/
public function insert($params = [])
{
     return Q::getTable()->create($params);
}


/**
 * Update data into database by defaut column is id
 * @param array $params 
 * @return 
*/
public function update($params = [])
{
    return Q::getTable()->update($params, $this->id);
}


/**
 * Delete one record from database
 * @param int $id
 * @return 
*/
public function delete($id=null)
{
   return Q::getTable()->delete($this->id);
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