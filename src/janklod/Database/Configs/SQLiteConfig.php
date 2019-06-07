<?php 
namespace JK\Database\Configs;

use \Config;

/**
 * @package JK\Database\Configs\SQLiteConfig 
*/ 
class SQLiteConfig 
{
     
     /**
      * Get all SQLite Configs
      * @return array
     */
	 public static function all()
	 {
         return [
		   'dbname'   => Config::get('database.dbname'),
		   'options'  => Config::get('database.options')
	     ];
	 }
}

