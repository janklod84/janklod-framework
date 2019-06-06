<?php 
namespace JK\Database\Drivers;


/**
 * @package JK\Database\Drivers\MySQLDriver
*/
class MySQLDriver extends CustomDriver
{
     
/**
* Connect  to PDO 
* @return \PDO
*/
public function connect()
{
    return new PDO($this->getDsn(), self::$config[]);
}

/**
* Get DSN
* @return string
*/
public function getDsn()
{
   return sprintf(
   	'mysql:host=%s;dbname=%s;port=%s;charset=%s;', 
   	self::$config['host'],  
   	self::$config['dbname'],
   	self::$config['port'],
   	self::$config['charset']
   );
}
}