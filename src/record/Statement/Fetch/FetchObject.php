<?php 
namespace JK\ORM\Statement\Fetch;


use \PDO;

/**
 * @package JK\ORM\Statement\Fetch\FetchObject
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