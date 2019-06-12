<?php 
namespace JK\ORM\Fetch;


use \PDO;

/**
 * @package JK\ORM\Fetch\FetchClass
*/ 
class FetchClass extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
           $className = $this->option('entity');
           if(!class_exists($className))
           {exit(sprintf('Sorry class <strong>%s</strong> does not exist!', $className));}
           $contructor_args = $this->argument('parameters');
           $mode = $this->argument('mode') ?: PDO::FETCH_CLASS;
           $this->statement->setFetchMode($mode, $className, $contructor_args);
      }

} 