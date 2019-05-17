<?php 
namespace JK\Database\Statement;


use \PDO;

/**
 * @package JK\Database\Statement\FetchClass
*/ 
class FetchClass extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($className = $this->getOption('entity'))
           {
               $contructor_args = $this->getOption('parameters');
               $this->statement->setFetchMode(PDO::FETCH_CLASS, $className, $contructor_args);
           }
      }

} 