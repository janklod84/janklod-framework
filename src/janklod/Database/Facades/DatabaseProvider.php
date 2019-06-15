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
     DB::open();
}  


/**
 * Register service
 * @return void
*/
public function register()
{
  
}


/**
 * Do something after registrer
 * 
 * @return void
*/
public function after()
{
	// DB::close();
}
}