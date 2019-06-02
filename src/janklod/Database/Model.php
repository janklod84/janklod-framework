<?php 
namespace JK\Database;


use \Q;
use \DB;


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
protected $connection;

/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app)
{
    $this->app = $app;
	$this->connection = $app->db ?: DB::instance();
    $this->model = get_class($this);
    $app->set('current.model', $this->model);
    Q::setup($this->connection);
}

}