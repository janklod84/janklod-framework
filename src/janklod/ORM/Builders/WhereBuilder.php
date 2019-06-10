<?php 
namespace JK\ORM\Builders;


/**
 * @package 
*/ 
class WhereBuilder extends CustomBuilder
{
     
     /**
      * Build conditions
      * @return string
     */
     public function build()
     {
     	 if($conditions = $this->params())
       {
              $conditioned = '';
              $types = [];
              foreach($conditions as $type => $wheres)
              {
                  $types[] = $type;
                  $conditioned .= sprintf('%s %s ', 
                                      $type, 
                                      implode(' '.$type.' ', $wheres)
                                );
              }
              
              return sprintf(' WHERE %s ', ltrim($conditioned, $types[0]));
       }
     }


}