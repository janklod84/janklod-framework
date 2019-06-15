<?php 
namespace JK\ORM;


use \PDO;
use \ReflectionClass;
use \Exception;


/**
 * Class Model
 * 
 * @package JK\ORM\Model 
*/ 
class Model 
{

	
/**
* @var string  $table         [ Table name ]
* @var bool    $softDelete    [ Deleting record soft ]
* @var array   $fillable      [ This is attributes you can add data ]
* @var array   $guarded       [ Attributes that won't get passed via the save method.]
* @var array   $hidden        [ Hidden attributes working via solftdelete ]
*/
protected static $table;
protected $solfDeleted  = false;
protected $fillable     = [];
protected $guarded      = ['id'];
protected $hidden       = [];



/**
* Constructor
* 
* @param PDO $pdo 
* @return void
*/
public function __construct() {}




/**
 * Do some action before storage data
 * 
 * @return void
*/
protected function beforeSave(){}


/**
 * Do some action after storage data
 * 
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
public static function all()
{
    return self::query()->findAll();
}


/**
 * Find First item from database by id
 * 
 * @param int $id
 * @return array
*/
public static function one(int $id)
{
    return self::where('id', $id);
}


/**
 * Find item from database
 * 
 * @param string $field 
 * @param string $operator 
 * @param mixed  $value 
 * @return array
*/
public static function where($field='', $value=null, $operator='=')
{
    return self::query()->where($field, $value, $operator);
}


/**
 * Delete item from Database
 * 
 * @param mixed  $value 
 * @param string $field 
 * @return bool
*/
public static function delete($value, $field='id')
{
	return self::query()->delete($value, $field);
}


/**
 * Get Query
 * 
 * @return \Query
*/
public static function query()
{
	 $model = get_called_class();
     $reflected = new ReflectionClass($model);
     $properties = $reflected->getStaticProperties();
     if(! self::$table = $properties['table'])
     {
     	  throw new Exception(
     	  sprintf(
     	  	'Property <strong>table</strong> is not setted in current class Model 
     	  	[ <strong>%s</strong> ]', $model
     	  ));
     }
	 return Query::table(self::$table);
}



}