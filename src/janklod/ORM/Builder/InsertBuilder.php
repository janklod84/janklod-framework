<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class InsertBuilder extends CustomBuilder
{
     
     /**
      * Build insert
      * @return string
     */
     public function build()
     {
             $table = $this->get('table');
             $insertQuery = sprintf('INSERT INTO `%s`', $table);
             if($columns = $this->get('columns'))
             {
                 $fields = $this->fields($columns);
                 $fill = array_fill(0, count($columns), '?');
                 $binds = implode(', ', $fill);
                 $insertQuery .= sprintf(' (%s) VALUES (%s)', $fields, $binds);
             }
             return $insertQuery;
     }
}