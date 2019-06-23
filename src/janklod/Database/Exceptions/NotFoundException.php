<?php 
namespace JK\Database\Exceptions;


class NotFoundException extends \Exception 
{


/**
* Constructor
* 
* @param string $table 
* @param int $id 
* @return 
*/
public function __construct(string $table, int $id)
{
   $this->message = sprintf("No record correspond identification #%s in the table '%s'", $id, $table);
}
}