<?php 
namespace JK\Database;


use JK\ORM\Q;


/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

protected $model;

/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app=null)
{
    $db = DB::instance();
    Q::setup($db);
    $this->model = get_class($this);
    register()->push('model', $this->model); 

}

}