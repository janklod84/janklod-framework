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
      * @param array $columns 
      * @return string
     */
     protected function fieldQuery($columns = [])
     {
        if(!empty($columns))
        {
            return '`' . implode('`, `', $columns) . '`';
        }
     }

    
     /**
      * Get fields with alias
      * @param array $columns 
      * @return string
      */
     protected function fieldWithAlias($columns)
     {
          if($alias = $this->sql('table.alias'))
          {
               $field = '';
               foreach($columns as $column)
               {
                   $field .= sprintf('`%s`.`%s`,', $alias, $column);
               }
               return trim($field, ',');
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
      * Set fields
      * @param array $fields 
      * @return string
     */
     protected function setField()
     {
         $fields = $this->sql('set');
         $set = '';
         foreach($fields as $field)
         {
             $set .= sprintf(' `%s` = ?,', $field);
         }
         return trim($set, ',');
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