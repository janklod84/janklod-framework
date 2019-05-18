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
}