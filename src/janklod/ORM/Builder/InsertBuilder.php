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
             $table = $this->sql('table');
             $insertQuery = sprintf('INSERT INTO `%s`', $table);
             if($insert = $this->sql('insert'))
             {
                 $insert = $this->sql('insert');
                 $fields = $this->fieldQuery($insert);
                 $fill = array_fill(0, count($insert), '?');
                 $binds = implode(', ', $fill);
                 $insertQuery .= sprintf(' (%s) VALUES (%s)', $fields, $binds);
             }
             return $insertQuery;
     }
}