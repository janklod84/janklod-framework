<?php 
namespace JK\ORM\Builders;


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
     	   if($joins = $this->params())
         {
              $joined = '';
              foreach($joins as $type => $joinParams)
              {
                      $typed = strtoupper($type);
                      if($typed === 'FULL')
                      {
                          $typed .= ' OUTER';
                      }
                      foreach($joinParams as $join)
                      {
                              $joined .= sprintf(' %s JOIN `%s` ON %s ', 
                                              $typed, 
                                              $this->table(), 
                                              $join['condition']);
                      }
              }
              return $joined;
         }
     }
}