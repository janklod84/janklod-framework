<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Sessions\Session;


/**
 * @package RequestProvider
*/
class RequestProvider extends ServiceProvider
{
       
/**
* Do action before register
* @return void
*/
public function boot()
{
    Session::start();
}

/**
 * Register service
 * @return void
*/
public function register()
{
	//..
}

}
