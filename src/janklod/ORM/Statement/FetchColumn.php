<?php 
namespace JK\ORM\Statement;


use \PDO;

/**
 * @package JK\ORM\Statement\FetchColumn
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