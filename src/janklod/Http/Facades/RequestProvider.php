<?php 
namespace JK\Http\Facades;

use JK\Service\ServiceProvider;
use JK\Http\Request;
use JK\Http\Sessions\Session;
use JK\Foundation\Source;


/**
 * @package JK\Http\Facades\RequestProvider
*/
class RequestProvider extends ServiceProvider
{


/**
 * Bootstrap
 * 
 * @return void
*/
public function boot()
{
    // Start session
	Session::start(
      $this->app->file->to(Source::CONFIG['session.path'])
	);
}


/**
 * Register 
 * @return type
*/
public function register()
{
}

}
