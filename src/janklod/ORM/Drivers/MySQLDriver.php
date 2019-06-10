<?php 
namespace JK\ORM\Drivers;


use \PDO;

/**
 * @package JK\ORM\Drivers\MySQLDriver
*/
class MySQLDriver extends CustomDriver
{
     
/**
* Connect  to PDO 
* 
* @return \PDO
*/
public function connect()
{
    return $this->pdo(
    	$this->dsn(), 
    	$this->config('username'), 
    	$this->config('password')
    );
}

/**
* Get DSN
* 
* @return string
*/
public function dsn()
{
   return sprintf(
   	'mysql:host=%s;dbname=%s;port=%s;charset=%s;', 
   	 $this->config('host'),  
   	 $this->config('dbname'),
   	 $this->config('port'),
   	 $this->config('charset')
   );
}
}