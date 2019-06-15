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

}