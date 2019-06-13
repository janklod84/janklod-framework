<?php 
namespace JK\Database;



/**
 * @package JK\Database\Model
*/ 
abstract class Model extends \JK\ORM\Model
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
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app)
{
   $this->app = $app;
   parent::__construct(Database::instance(), $this->table);
}


}