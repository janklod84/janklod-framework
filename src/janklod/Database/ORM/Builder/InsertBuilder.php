<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class InsertBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
             $table = $this->sql('table');
             $insertQuery = sprintf('INSERT INTO `%s`', $table);
             if(!$this->hasQuery('set') && $this->hasValue('insert'))
             {
                 $insert = $this->sql('insert');
                 $fields = $this->fieldQuery($insert);
                 $fill = array_fill(0, count($insert), '?');
                 $binds = implode(', ', $fill);
                 $insertQuery .= sprintf(' (%s) VALUES (%s)', $fields, $binds);
             }
             return $insertQuery;

             /*
             return sprintf('INSERT INTO `%s` (%s) VALUES (%s)', $table, $fields, $binds);
             */
     }
}