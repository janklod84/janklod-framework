<?php 
namespace JK\ORM\Statement;


use \PDO;

/**
 * @package JK\ORM\Statement\FetchClass
*/ 
class FetchClass extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           if($className = $this->option('entity'))
           {
               $contructor_args = $this->argument('parameters');
               $mode = $this->argument('mode') ?: PDO::FETCH_CLASS;
               $this->statement->setFetchMode($mode, $className, $contructor_args);
           }
      }

} 