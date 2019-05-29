<?php 
namespace JK\Database;


use JK\ORM\Q;


/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

  /**
   * Constructor
   * @param \JK\Container\ContainerInterface $app
   * @return void
  */
  public function __construct($app=null)
  {
      $db = DB::instance();
      Q::setup($db);
  }

}