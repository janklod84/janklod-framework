<?php 
namespace JK\Database\Facades;

use JK\DI\ServiceProvider;
use \DB;


/**
 * @package JK\Database\Facades\DatabaseProvider
*/ 
class DatabaseProvider extends ServiceProvider
{


/**
 * Bootstrap
 * 
 * @return void
*/
public function boot()
{
     DB::connect();
}  


/**
 * Register service
 * @return void
*/
public function register()
{
  
}


public function after()
{
	// DB::deconnect();
}
}