<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
abstract class CustomBuilder
{
     
     /**
      * @var array $sql
     */
     protected $sql;
     

     /**
      * Constructor
      * @param array $sql 
      * @return void
     */
     public function __construct($sql)
     {
          $this->sql = $sql;
     }

     
     /**
      * Builder query
      * @return string
     */
     abstract public function build();

     
     /**
      * Field builder
      * @param array $params 
      * @return string
     */
     protected function fieldQuery($params = [])
     {
        if(!empty($params))
        {
           return '`' . implode('`, `', $params) . '`';
        }
     }

    
     /**
      * Get table
      * @return string
     */
     protected function tableQuery()
     {
         $query = '`'. $this->sql('table') . '`';
         if($alias = $this->sql('table.alias'))
         {
              $query .= ' AS ' . $alias;
         }
         return $query;
     }

     
     /**
      * Get sql
      * @param string $key 
      * @return mixed
     */
     protected function sql($key)
     {
          if($this->hasQuery($key))
          {
              return $this->sql[$key];
          }
          return false;
     }
     
     
     /**
      * Determine if sql
      * @param string $key 
      * @return bool
     */
     protected function hasValue($key)
     {
         return ! empty($this->sql[$key]);
     }


     /**
      * Determine if has query
      * @param string $key 
      * @return bool
     */
     protected function hasQuery($key)
     {
         return isset($this->sql[$key]);
     }
}