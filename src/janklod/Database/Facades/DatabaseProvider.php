<?php 
namespace JK\Database\Facades;

use JK\Service\ServiceProvider;
use \DB;



/**
 * @package JK\Database\Facades\DatabaseProvider
*/ 
class DatabaseProvider extends ServiceProvider
{
        
/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('db', function () {
        return DB::instance();
    });
}


}