<?php 
namespace JK\Database\Statement;


use \PDO;

/**
 * @package JK\Database\Statement\FetchInto
*/ 
class FetchInto extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($object = $this->getOption('object'))
           {
                $this->statement->setFetchMode(PDO::FETCH_INTO, $object);
           }
      }

} 