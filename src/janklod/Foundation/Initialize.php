<?php 
namespace JK\Foundation;


use JK\Config\Config;
use JK\Http\Sessions\Session;


/**
 * @package JK\Foundation\Initialize
**/ 
class Initialize
{

/**
 * @var JK\Container\ContainerInterface
*/
private $app;

/**
 * Runners
*/
private static $runners = [
 \JK\Foundation\Runners\AliasRunner::class,
 \JK\Foundation\Runners\ProviderRunner::class,
 \JK\Foundation\Runners\FunctionRunner::class,
 \JK\Foundation\Runners\CommandRunner::class,
];


/**
 * Constructor
 * @param JK\Container\ContainerInterface $app 
 * @return void
*/
public function __construct($app)
{
	// Start session
	Session::start();

	// Get container
    $this->app = $app;
    
    // Load all configuration
    \JK\Config\Config::basePath(
     $this->app->file->to('app/config')
    )->map();
}


/**
 * Run application services
 * @return void
*/
public function run()
{
    foreach(self::$runners as $runner)
    {
       $this->callRunner($runner);
    }
}


/**
 * Get callback
 * @param string $runner 
 * @return void
*/
private function callRunner($runner)
{
	 if(!class_exists($runner))
	 {
	 	  throw new \Exception(
	 	  sprintf('Sorry class <strong>%s</strong> does not exist!', $runner), 
	 	  404
	 	 );
	 }

	 $callback = [new $runner($this->app), 'init'];

	 if(!is_callable($callback))
	 {
         throw new \Exception(
         'Sorry can not get this callback',
	 	  404
	 	 );
	 }
	 call_user_func($callback);
}

}