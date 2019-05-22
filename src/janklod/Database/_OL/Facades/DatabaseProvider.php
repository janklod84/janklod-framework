<?php 
namespace JK\Database\Facades;

use JK\Service\ServiceProvider;
use JK\Database\DatabaseManager;



/**
 * @package RequestProvider
*/
class DatabaseProvider extends ServiceProvider
{
       
       /**
        * Registering request provider
        * @return type
       */
       public function register()
       {
       	   $this->app->singleton('db', function () {
               return DatabaseManager::connect();
           });
       }
}
