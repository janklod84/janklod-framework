<?php 
namespace JK\Database;


use \Config;

/**
 * @package JK\Database\DatabaseConfig
*/ 
class DatabaseConfig 
{
       
/**
* Get config
* @param string $key 
* @return mixed
*/
protected static function get(string $key='')
{
	  return Config::get('database.'.$key);
}
 
/**
* Get dsn
* @return string
*/
public static function dsn()
{
     return self::get('dsn');
}

/**
* Get user
* @return string
*/
public static function user()
{
     return self::get('user');
}


/**
* Get password
* @return string
*/
public static function password()
{
     return self::get('password');
}


/**
* Get password
* @return string
*/
public static function options()
{
     return self::get('options');
}


}