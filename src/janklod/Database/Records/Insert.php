<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Insert extends CustomRecord 
{
      
      /**
       * Insert data
       * @param string $table
       * @param array $params
       * @return 
      */
      public function data($params = [])
      {
      	   $sql = $this->builder
                       ->insert($this->table, $params)
                       ->sql();
           return $this->execute($sql, $this->valueQuery(), false);
      }
}