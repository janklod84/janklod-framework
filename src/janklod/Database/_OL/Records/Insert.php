<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Insert extends Record 
{
      
      /**
       * Insert data
       * @param string $table
       * @return 
      */
      public function data()
      {
      	   $sql = $this->builder
                       ->insert($this->table, $this->params)
                       ->sql();
           return $this->execute($sql, $this->values(), false);
      }
}