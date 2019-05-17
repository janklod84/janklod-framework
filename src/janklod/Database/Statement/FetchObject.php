<?php 
namespace JK\Database\Statement;


use \PDO;

/**
 * @package JK\Database\Statement\FetchObject
*/ 
class FetchObject extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           $this->statement->setFetchMode(PDO::FETCH_OBJ);
      }

} 