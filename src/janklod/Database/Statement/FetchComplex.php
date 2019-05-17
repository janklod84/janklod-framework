<?php 
namespace JK\Database\Statement;


use \PDO;

/**
 * @package JK\Database\Statement\FetchComplex
*/ 
class FetchComplex extends Fetch
{
      
      /**
       * set fetch mode
       * @return void
      */
      public function setMode()
      {
      	   $mode = $this->getOption('mode');
           if($mode === PDO::FETCH_CLASS)
           {
               // ..
           }
      }

} 