<?php 
namespace JK\ORM\Builder;


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
      * [ '`' . implode('`, `', $columns) . '`' ]
      * @param array $columns 
      * @return string
     */
     protected function fieldQuery($columns = [])
     {
        if(count($columns) > 1)
        {
             return '`' . implode('`, `', $columns) . '`';
        }
        return implode($columns);
     }

    
     /**
      * Get table
      * @return string
     */
     protected function tableQuery()
     {
         if($table = $this->sql('table'))
         {
             $tableString = '';
             if(is_array($table))
             {
                $tableString = '`'.$table[0].'`';
                if(!empty($table[1]))
                {
                   $tableString .= ' AS '.$table[1];
                }
                
             }else{
                  $tableString = '`'.$table.'`';
             }
             return $tableString;
         }
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
      * Determine if has query
      * @param string $key 
      * @return bool
     */
     protected function hasQuery($key)
     {
         return isset($this->sql[$key]);
     }
}