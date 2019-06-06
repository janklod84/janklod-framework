<?php 
namespace JK\Database\Drivers;


/**
 * @package JK\Database\Drivers\SQLiteDriver
*/
class SQLiteDriver extends CustomDriver
{
     
     /**
      * Constructor
      * @param array $config 
      * @return \PDO
     */
     public static function connect($config=[])
     {
           debug($config);
     }
}