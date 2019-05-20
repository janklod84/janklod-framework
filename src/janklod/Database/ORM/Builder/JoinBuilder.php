<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class JoinBuilder extends CustomBuilder
{
     
     /**
      * Build Join
      * @return string
     */
     public function build()
     {
     	   if($joins = $this->sql('join'))
         {
              $joined = '';
              foreach($joins as $type => $joinParams)
              {
                  $typed = strtoupper($type);
                  if($typed === 'FULL')
                  {
                      $typed .= ' OUTER';
                  }
                  foreach($joinParams as [$table, $condition])
                  {
                       $joined .= sprintf(' %s JOIN `%s` ON %s ', 
                                          $typed, 
                                          $table, 
                                          $condition);
                  }
              }
              return $joined;
         }
     }
}