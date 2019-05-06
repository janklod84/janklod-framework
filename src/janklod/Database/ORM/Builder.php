<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\Builder 
*/ 
class Builder
{
       
     /**
      * select 
      * @param array $parses 
      * @return string
     */
	   public static function select($parses)
	   {
	   	    $fields = implode($parses) ?: "*";
            if(count($parses) > 1)
            {
            	$fields = '`'. implode('`, `', array_values($parses)) . '`';
            }
            return sprintf('SELECT %s', $fields);
	   }

       
     /**
      * from
      * @param string $table 
      * @return string
     */
	   public static function from($table)
	   {
	   	   return sprintf('FROM `%s`', $table);
	   }

     
     /**
      * where
      * @param string $column 
      * @param string $operator 
      * @param string $value 
      * @return string
     */
	   public static function where($column, $operator, $value)
	   {
	   	  return sprintf('%s %s %s', $column, $operator, $value);
	   }

     
     /**
      * Group by
      * @param string $groupBy
      * @return string
    */
     public static function groupBy($groupBy)
     {
        return sprintf("GROUP BY %s ", $groupBy);
     }

     
     /**
      * Having 
      * @param string $havingSql 
      * @return string
     */
     public static function having($havingSql)
     {
        return sprintf("HAVING %s ", $havingSql);
     }


     /**
       * Query Order by
       * orderby('id', 'DESC')
       * 
       * @param $field
       * @param $sort
       * @return $this
      */
      public function orderby($field, $sort)
      {
            $sql = sprintf(' ORDER BY %s %s ', $field, $sort);
            if(!$field)
            {
                $sql = '';
            }

            return $sql;
            
      }

      
      /**
       * Truncate
       * @param string $table 
       * @return string
       */
      public static function truncate($table)
      {
          return sprintf("TRUNCATE TABLE `%s`", $table);
      }

}