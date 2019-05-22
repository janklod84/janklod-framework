<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class FetchMode extends Record
{
      
      /**
       * Set mode entity
       * @param string $entity
       * @return 
      */
      public function entity($entity='')
      {
          $this->query->fetchClass($entity);
      }

      
      /**
       * Set mode column
       * @param string $colno 
       * @return void
      */
      public function column($colno)
      {
         $this->query->fetchColumn($colno);
      }
}