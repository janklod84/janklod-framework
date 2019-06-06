<?php 
namespace JK\Database\Config;

use \Config;

/**
 * @package JK\Database\Config\MySQLConfig 
*/ 
class MySQLConfig 
{
     
     /**
      * Get all MySQL configuration
      * @return array
     */
	 public static function all()
	 {
         return [
		  // 'dsn'           => Config::get('database.dsn'),
		     'dbname'        => Config::get('database.dbname'),
		     'host'          => Config::get('database.host'),
		     'port'          => Config::get('database.port'),
		     'charset'       => Config::get('database.charset'),
		     'username'      => Config::get('database.user'),
		     'password'      => Config::get('database.password'),
		     'options'       => Config::get('database.options'),
		     'prefix_tbl'    => Config::get('database.prefix_tbl'),
		     'collation'     => Config::get('database.collation'),
		     'engine'        => Config::get('database.engine'),
		     'autocreate'    => false
	     ];
	 }
}

