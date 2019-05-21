<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Update extends CustomRecord 
{
      
      /**
       * Insert data
       * @return 
      */
      protected function data($params = [])
      {
      	   $sql = $this->builder()
                       ->insert($this->table, $params)
                       ->sql();
           return $this->execute($sql, $this->valueQuery(), false);
      }
}