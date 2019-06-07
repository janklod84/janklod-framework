<?php 
namespace JK\Database;

use JK\Database\Configs\{
	MySQLConfig,
	SQLiteConfig
};

/**
 * Configure [ factory database configuration ]
 * @package JK\Database\Configuration
*/
class Configuration 
{
   
/**
 * Get configuration
 * @var string $driver
 * @return array
 * @throws \Exception
*/
public static function check($driver)
{
  switch($driver)
  {
    case 'mysql':
      return MySQLConfig::all();
    break;
    case 'sqlite':
      return SQLiteConfig::all();
    break;
    default:
     throw new \Exception("No Driver checked!", 404);
  }
}
}