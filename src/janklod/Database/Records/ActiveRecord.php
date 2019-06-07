<?php 
namespace JK\Database;

use JK\ORM\Q;

/**
 * @package JK\Database\ActiveRecord 
*/ 
class ActiveRecord
{


/**
 * @var  string $table
 * @var  int $id
*/
protected $table;
protected $id;


/**
 * Constructor
 * @return void
*/
public function __construct()
{
    /*
    Q::setup(\DB::instance());
    Q::fetchClass(__CLASS__);
    Q::addTable($this->table);
    $this->onConstructor();
    */
}


/**
 * Do some action before next actions
 * @return void
*/
public function onConstructor(){}



/**
 * Do some action before storage data
 * Do some action after storage data
 * @return void
*/
protected function beforeSave(){}
protected function afterSave(){}


/**
 * Get name of table
 * @return string
*/
public function getTable()
{
    return $this->table;
}


/**
 * Fetch columns
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
    /* return Q::getTable()->all(); */
}


/**
 * Find record by id
 * @return array
*/
public function findById()
{
    /* return Q::getTable()->read($this->id); */
}



/**
 * Find record by field by defaut column is id
 * @param string $field 
 * @param string $value 
 * @return array
*/
public function findBy($field='id', $value=null)
{
     /* Q::getTable()->read($value, $field); */
}


/**
 * Save data
 * @return mixed
*/
public function save()
{
    
}


/**
 * Determine if has new record or not
 * @return bool
*/
protected function isNew(): bool
{
    /* return property_exists($this, 'id') 
           && isset($this->id); */
}


}