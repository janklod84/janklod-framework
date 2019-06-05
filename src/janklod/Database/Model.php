<?php 
namespace JK\Database;


use \Q;


/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

/**
 * @var string $model [ This is model name ]
 * @var \JK\Container\ContainerInterface $app
*/
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
	$this->connection = $app->db;
    Q::setup($this->connection);
    $this->app->load->call($this, 'onConstructor');
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

}