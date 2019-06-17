<?php 
namespace JK\Foundation\Http;


use JK\Http\Contracts\{
 RequestInterface, 
 ResponseInterface
};

use JK\Foundation\{
  Application,
  Initialize
};
use JK\Routing\Router;
use JK\Config\Config;


/**
 * 
 * @package JK\Foundation\Http\Kernel
*/ 
class Kernel
{



/**
 * @var ContainerInterface $app
 * @var Router $router
*/
protected $app;
protected $router;


/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
	// Get container
	$this->app = Application::instance()->container();

	// Load all configuration
    $path = $this->app->file->to('app/config/*');
    Config::map($path);
}


/**
 * Handler
 * 
 * @param \JK\Http\Contracts\RequestInterface $request 
 * @return \JK\Http\Contracts\ResponseInterface $response
*/
public function handle(RequestInterface $request): ResponseInterface
{ 
if(! $request->is('cli'))
{
	// Initialize all services [ Bootstrap of application ]
    (new Initialize($this->app))->run();
    
    // Require all routes
    $this->app->file->call('routes/app.php');

    // Get URL
	$url = $request->get('url');

    // Instance de Router
	$this->router = new Router($url);

	// Get request method
	$method = $request->method();

	// Get dispatcher
	$dispatcher = $this->router->dispatch($method);
    
    // Get callaback and matches params
	$callback = $dispatcher->getCallback();
    $matches  = $dispatcher->getMatches();

    // Storing output for sending to response class
    $output = $this->app->load->callAction($callback, $matches);
    
    // Set output
    $output = (string) $output;
    return $this->app->response->withBody($output);
}
}


/**
 * Send reponse to server
 * 
 * @param  JK\Http\Contracts\RequestInterface  $request 
 * @param  JK\Http\Contracts\ResponseInterface $response
 * @return void
*/
public function terminate(RequestInterface $request, ResponseInterface $response)
{

      // capture les notifications for now
	  $this->notify();
}


/**
 * Show messages
 * 
 * @return void
*/
private function notify()
{
   $debogger = new \JK\Debug\Debogger($this->app);
   $debogger->output(\Config::get('app.debug'));
}


}