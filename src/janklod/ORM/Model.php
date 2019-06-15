<?php 
namespace JK\ORM;


use PDO;


/**
 * Class Model
 * 
 * @package JK\ORM\Model 
*/ 
class Model 
{

	
/**
* @var string $table
* @var array  $fillable
* @var array  $guarded
*/
protected $table    = '';
protected $fillable = [];
protected $guarded  = ['id'];


/**
* Constructor
* 
* @param PDO $pdo 
* @return void
*/
public function __construct(\PDO $pdo)
{
	Query::setup($pdo, $this->table);
}



/**
 * Do some action before storage data
 * @return void
*/
protected function beforeSave(){}


/**
 * Do some action after storage data
 * @return void
*/
protected function afterSave(){}


/**
 * Save item curren model in to database
 * Alternance update | insert
 * 
 * @return void
*/
public function save()
{
     
}


/**
 * Find all
 * 
 * @return array
*/
public static function all(): array
{
    return Query::table()->findAll();
}


/**
 * Find item from database by id
 * 
 * @param int $id
 * @return array
*/
public static function one(int $id)
{
    return self::where($id);
}


/**
 * Find item from database
 * 
 * @param mixed  $value 
 * @param string $field 
 * @param string $operator 
 * @return array
*/
public static function where($value, $field='id', $operator='=')
{
    return Query::table()->where($field, $value, $operator);
}


/**
 * Delete item from Database
 * 
 * @param mixed $value 
 * @param string $field 
 * @return bool
*/
public static function delete($value, $field='id')
{
	return Query::table()->delete($value, $field);
}

}