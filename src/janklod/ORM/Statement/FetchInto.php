<?php 
namespace JK\ORM\Statement;


use \PDO;

/**
 * @package JK\ORM\Statement\FetchInto
*/ 
class FetchInto extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($object = $this->option('object'))
           {
                $mode = $this->argument('mode') ?: PDO::FETCH_INTO;
                $this->statement->setFetchMode($mode, $object);
           }
      }

} 