<?php 
namespace JK\Database;


use JK\ORM\Q;


/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

/**
 * @var string $model [ This is model name ]
 * @var \JK\Container\ContainerInterface $app
*/
protected $model;
protected $table;
protected $app;


/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app = null)
{
	$this->model = get_class($this);
    $connection  = DatabaseManager::instance();
    if(!is_null($app))
    {
       $this->app  = $app;
       $connection = $app->db;
       $app->set('current.model', $this->model);
    }
    Q::setup($connection);
    if($this->table)
    { Q::addTable($this->table); }
}

}