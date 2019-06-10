<?php 
namespace JK\Database;



/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

/**
 * @var \JK\Container\ContainerInterface $app
 * @var \PDO $connection
*/
protected $app;
protected $connection;



/**
 * Constructor
 * @param \JK\Container\ContainerInterface $app
 * @return void
*/
public function __construct($app)
{

}


}