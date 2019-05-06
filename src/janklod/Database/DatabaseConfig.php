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
	   public static function get(string $key='')
	   {
	   	   return Config::get('database.'.$key);
	   }
}