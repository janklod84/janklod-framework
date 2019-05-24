<?php 
namespace JK\ORM\Statement\Fetch;


use \PDO;

/**
 * @package JK\ORM\Statement\Fetch\FetchColumn
*/ 
class FetchColumn extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($colno = $this->option('column'))
           {
                $mode = $this->argument('mode') ?: PDO::FETCH_COLUMN;
                $this->statement->setFetchMode($mode, $colno);
           }
      }

} 