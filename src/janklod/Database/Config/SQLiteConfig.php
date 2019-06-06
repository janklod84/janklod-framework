<?php 
namespace JK\Database\Config;

use \Config;

/**
 * @package JK\Database\Config\SQLiteConfig 
*/ 
class SQLiteConfig 
{
     
     /**
      * Get all SQLite configuration
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

