<?php 
namespace JK\Database;


use JK\ORM\QQ;


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
      QQ::setup($db);
  }

}