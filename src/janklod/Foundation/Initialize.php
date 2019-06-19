<?php 
namespace JK\Foundation;

use JK\DI\Contracts\ContainerInterface;

/**
 * @package JK\Foundation\Initialize
**/ 
class Initialize
{



/**
 * @var JK\DI\Contracts\ContainerInterface
*/
private $app;



/**
 * Constructor
 * 
 * 
 * @param JK\DI\Contracts\ContainerInterface $app 
 * @return void
*/
public function __construct(ContainerInterface $app)
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
    // Stating all services
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