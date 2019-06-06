<?php 
namespace JK\Database\Drivers;


/**
 * @package JK\Database\Drivers\SQLiteDriver
*/
class SQLiteDriver extends CustomDriver
{
     
/**
* Connect  to PDO 
* @return \PDO
*/
public function connect()
{
    return $this->pdo($this->dsn(), null, null);
}

/**
* Get DSN
* @return string
*/
public function dsn()
{
   return sprintf(
   	'sqlite:%s',  
   	 $this->config('dbname')
   );
}

}