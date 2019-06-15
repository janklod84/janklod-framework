<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;
use \Exception;



/**
 * @package JK\ORM\Connection
*/ 
class Connection 
{

/**
 * @const array [ allowed keys ]
*/
const ALLOWED_CONFIG_KEYS = [
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
    $driver = strtolower($driver);
    self::validation($config);
    extract($config);

    if(self::has_driver($driver))
    {
        return ConnectionFactory::pdo($driver, $config)->connect();
    }

  }catch(\PDOException $e){

      throw new Exception($e->getMessage(), 404);
  }

}



/**
 * Make sure has available driver
 * 
 * @param string $driver 
 * @return bool
 * @throws \Exception 
*/
private static function has_driver($driver=null)
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
private static function validation($config)
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