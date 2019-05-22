<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Entity extends CustomRecord 
{
      
      /**
       * Add Fetch Class Mode 
       * @param string $entity
       * @return 
      */
      public function setMode($entity='')
      {
      	  $this->query->fetchClass($entity);
      }
}