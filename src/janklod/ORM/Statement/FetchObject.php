<?php 
namespace JK\ORM\Statement;


use \PDO;

/**
 * @package JK\ORM\Statement\FetchObject
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