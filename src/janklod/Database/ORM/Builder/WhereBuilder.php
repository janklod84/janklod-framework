<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class WhereBuilder extends CustomBuilder
{
     
     /**
      * Build where
      * @return string
     */
     public function build()
     {
     	 if($wheres = $this->sql('where'))
     	 {
            $where = implode(' AND ', array_values($wheres));
     	    return sprintf('%s', $where);
     	 }
     }
}