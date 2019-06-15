<?php 
namespace JK\Database;


use JK\ORM\Model as DatabaseModel;


/**
 * @package JK\Database\Model
*/ 
abstract class Model extends DatabaseModel
{

/**
 * @var ContainerInterface $app
 * @var string $table
 * @var array  $fillable
 * @var array  $guarded
*/
protected $app;
protected $table = '';
protected $fillable = [];
protected $guarded  = ['id'];



/**
 * Constructor
 * 
 * @param ContainerInterface $app
 * @return void
*/
public function __construct($app = null)
{
   $this->app = $app;
   parent::__construct(Database::instance(), $this->table);
}


/**
public static function findAll()
{
    Query::table()->findAll();
}
*/

}