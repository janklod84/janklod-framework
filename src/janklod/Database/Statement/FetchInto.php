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
           if($object = $this->option('object'))
           {
                $mode = $this->argument('mode') ?: PDO::FETCH_INTO;
                $this->statement->setFetchMode($mode, $object);
           }
      }

} 