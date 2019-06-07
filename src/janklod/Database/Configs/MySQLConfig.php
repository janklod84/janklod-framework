<?php 
namespace JK\Database\Configs;

use \Config;

/**
 * @package JK\Database\Configs\MySQLConfig 
*/ 
class MySQLConfig 
{
     
/**
* Get all MySQL Configs
* @return array
*/
public static function all()
{
 return [
     'dbname'        => Config::get('database.dbname'),
     'host'          => Config::get('database.host'),
     'port'          => Config::get('database.port'),
     'charset'       => Config::get('database.charset'),
     'username'      => Config::get('database.user'),
     'password'      => Config::get('database.password'),
     'options'       => Config::get('database.options'),
     'autocreate'    => false
 ];
}
}

