<?php 
namespace JK\Http\Facades;

use JK\DI\ServiceProvider;
use JK\Http\Sessions\Session;
use JK\Foundation\Source;


/**
 * @package JK\Http\Facades\SessionProvider
*/
class SessionProvider extends ServiceProvider
{


/**
 * @var string
*/
private $session_dir;


/**
 * Bootstrap
 * 
 * @return void
*/
public function boot()
{
    // Start session
    $this->session_dir =  $this->app->file->to(
    	Source::CONFIG['session.dir']
    );

    if(! \Config::get('session.storage'))
	{
		  $this->session_dir = false;
	}

	Session::start($this->session_dir);

}


/**
 * Register 
 * @return type
*/
public function register()
{
}


}
