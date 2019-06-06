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
protected $app;
protected $db;



/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app)
{
	$this->app = $app;
	$this->db  = $app->db;
	// Q::setup($this->db);
}


}