<?php 
namespace JK\Foundation;
use JK\Config\Config;



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
 * Constructor
 * 
 * 
 * @param JK\Container\Contrats\ContainerInterface $app 
 * @return void
*/
public function __construct($app)
{
    // Get container
    $this->app = $app;
}


/**
 * Run application services
 * 
 * @return void
*/
public function run()
{
    foreach(Source::CONFIG['runners'] as $runner)
    {
        $this->call($runner);
    }
}


/**
 * Get callback
 * 
 * @param string $runner 
 * @return void
*/
private function call($runner)
{
 if(!class_exists($runner))
 {
 	  throw new \Exception(
 	  sprintf(
      'Sorry class <strong>%s</strong> does not exist!', 
       $runner
      ), 
 	  404
 	 );
 }
 
 $runnerObj = new $runner($this->app);
 $callback = [$runnerObj, 'init'];
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