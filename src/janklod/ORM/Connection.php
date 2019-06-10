<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;
use \Exception;

use JK\ORM\Drivers\{
 MySQLDriver,
 SQLiteDriver
};


/**
 * @package JK\ORM\Connection
*/ 
class Connection 
{

/**
 * @const array [ allowed keys ]
*/
const ALLOWED_CONFIG_KEYS = [
 'driver',
 'dbname',
 'host',
 'port',
 'charset', 
 'username',
 'password',
 'options', 
 'prefix',
 'collation',
 'engine',
 'autocreate',
];



/**
 * Make connection
 * 
 * @param string $driver
 * @param array $config 
 * @return \PDO 
 * @throws \Exception
*/
public static function make($driver='mysql', $config = [])
{
  try 
  {
    $driver = mb_strtolower($driver);
    self::config_validate($config);
    extract($config);

    if(self::is_valid_driver($driver))
    {
       return self::connect($driver, $config);
    }

  }catch(\PDOException $e){

      throw new Exception($e->getMessage(), 404);
  }

}



/**
 * Call MySQL connection
 * 
 * [
 * 'dbname'   => '',
 * 'host'     => '',
 * 'port'     => '',
 * 'charset'  => '',
 * 'username' => '',
 * 'password' => '',
 * 'options'  => ''
 * ];
 *
 * @param array $config 
 * @return \PDO
*/
private static function mysql($config=[])
{
    return call_user_func([new MySQLDriver($config), 'connect']);
}


/**
 * Call SQLite connection
 * 
 * [
 * 'dbname'   => '',
 * 'options'  => ''
 * ];
 * 
 * @param array $config 
 * @return \PDO
*/
private static function sqlite($config=[])
{
   return call_user_func([new SQLiteDriver($config), 'connect']);
}


/**
 * Get current connection
 * 
 * @param string $driver 
 * @param string $config 
 * @return mixed
 * @throws \Exception
*/
private static function connect($driver, $config)
{
     $method = strtolower($driver);
     $callback = [new static, $method];
     if(!is_callable($callback))
     {
          throw new Exception(
            sprintf('Sorry, Connection to [%s] does not implemented yet!', $driver), 
            404
          );
          
     }
     return call_user_func($callback, $config);
}

/**
 * Make sure has available driver
 * 
 * @param string $driver 
 * @return bool
 * @throws \Exception 
*/
private static function is_valid_driver($driver=null)
{
     if(!in_array($driver, PDO::getAvailableDrivers(), true))
     {
     	  throw new Exception("Current driver is not available!", 404); 
     }
     return true;
}


/**
 * Make sure config params matches
 * 
 * @param array $config 
 * @return void
 * @throws \Exception
*/
private static function config_validate($config)
{
   foreach(array_keys($config) as $key)
   {
      if(!in_array($key, self::ALLOWED_CONFIG_KEYS))
      {
          throw new Exception(
            sprintf('Sorry, key [%s] is not valid!', $key)
          );
      }
   }
}


}