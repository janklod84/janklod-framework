<?php 
namespace JK\Database\Records;


/**
 * @package 
*/ 
class Select extends Record
{
      
/**
 * Make Select Sql
 * select all columns
 * @return QueryBuilder
*/
protected function makeQuery()
{
	   return $this->builder
                 ->select()
                 ->from($this->table);
}

/**
 * Make Select Query
 * @return Query
*/
protected function record()
{
	   $sql = $this->makeQuery();
     return $this->execute($sql);
}


/**
 * Find all
 * @return mixed
*/
public function all()
{
    return $this->record()->results();
}


/**
   * Find first
   * @return mixed
*/
public function first()
{
      return $this->record()->first();
}

      

/**
 * Execute where record
 * @param string $field 
 * @param string $value
 * @param string $limit
 * @return 
*/
public function where($field, $value)
{
       $sql = $this->makeQuery()
                   ->where($field, $value)
                   ->limit(1)
                   ->sql();
       return $this->execute($sql, $this->values())
                   ->results();
}


}