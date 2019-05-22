<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Update extends RecordManager
{

      /**
       * Insert data
       * @param string $column
       * @param mixed $value
       * @return 
      */
      public function where($column, $value=null)
      {
            $sql = $this->builder()
                        ->update($this->table)
                        ->set($this->params);
                        ->where($column, $value);
            return $this->execute($sql, $this->values(), false);
      }




}