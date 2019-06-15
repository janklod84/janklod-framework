<?php 
namespace JK\ORM;


use JK\ORM\Drivers\{
 MySQLDriver,
 SQLiteDriver
};

use JK\ORM\Adapters\DriverAdapter;



/**
 * @package JK\ORM\ConnectionFactory
*/
class ConnectionFactory
{

/**
 * @var object $connection [ Current connection ]
*/
private static $connection;

/**
  * Connect to available driver
  * 
  * @param string $driver 
  * @return \PDO
*/ 
public static function pdo($driver='', $config=[])
{      
   switch($driver)
   {
     case 'mysql':
     self::$connection = new MySQLDriver($config);
     break;
     case 'sqlite':
     self::$connection = new SQLiteDriver($config);
     break;
   }

   return call_user_func(
   	[new DriverAdapter(self::$connection), 'connect']
   );
}


}