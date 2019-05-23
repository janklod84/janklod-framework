<?php 
namespace JK\Database;


use JK\ORM\{
  Query,
  QueryBuilder
};

/**
 * @package JK\Database\Model
*/ 
abstract class Model
{


  /**
   * @var \PDO $connection
   * @var \JK\ORM\Query
   * @var \JK\ORM\QueryBuilder
  */
  protected static $connection;
  protected $query;
  protected $queryBuilder;
  
  
  /**
   * Constructor
   * @return void
  */
  public function __construct()
  {
      $this->query = new Query(
          self::connect()
      );
      $this->queryBuilder = new QueryBuilder();
  }


 
  /**
   * Get connection to database
   * @return \PDO 
  */
  protected static function connect()
  {
      if(is_null(self::$connection))
      {
          self::$connection = DatabaseManager::instance();
      }
      return self::$connection;
  }


     
}