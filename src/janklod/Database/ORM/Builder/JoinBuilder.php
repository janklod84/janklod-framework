<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class JoinBuilder extends CustomBuilder
{
     
     /**
      * Build limit
      * @return string
     */
     public function build()
     {
     	 if($join = $this->sql('join'))
         {
              // sprintf('%s JOIN %s ON %s', 'INNER', 'users', 'users.id = categories.user_id');
         }
     }
}