<?php 
namespace JK\Database\Statement;


use \PDO;

/**
 * @package JK\Database\Statement\FetchColumn
*/ 
class FetchColumn extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($colno = $this->getOption('column'))
           {
                $this->statement->setFetchMode($this->fetchMode, $colno);
           }
      }

} 