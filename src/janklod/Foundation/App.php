<?php 
namespace JK\Foundation;


use JK\Http\Contracts\{
  RequestInterface,
  ResponseInterface
};

use JK\FileSystem\File;
use JK\Config\Config;
use JK\Exception\Error;
use JK\Exception\Support\WhoopsAdapter;
use JK\Routing\Router;



/**
 * Application
 * 
 * @package JK\Foundation\App
*/ 
final class App
{

         
/**
 * Instance of Application
 * @var JK\Foundation\App
*/
private static $instance;


/**
 * Container Dependency Injection Interface
 * @var  JK\DI\Contracts\ContainerInterface $app
*/
private $app;



/**
* prevent instance from being cloned
*/
private function __clone(){}



/**
* prevent instance from being unserialized
*/
private function __wakeup(){}


/**
  * Contructor
  * 
  * @return void
*/
private function __construct()
{
   // Get container
   $this->app = $this->container();
}


/**
 * Bootstrap of Application
 * 
 * @return void
*/
public function bootstrap()
{
   // Capture all Errors
   Error::capture(new WhoopsAdapter());
   
   // Load all configuration
   $path = $this->file->to('app/config/*');
   Config::map($path);

   // Initialize all services 
   (new Initialize($this->app))->run();
}


/**
 * Handle Application
 * 
 * @param  RequestInterface $request 
 * @return ResponseInterface
*/
public function handle(RequestInterface $request): ResponseInterface
{
   if(!$request->is('cli'))
   {
      // Require all routes
      $this->file->call('routes/app.php');

      // Get URL
      $url = $request->getPath();

      // Instance de Router
      $router = $this->make(Router::class, [$url]);

      // Get request method
      $method = $request->method();
    
      // Get dispatcher
      $dispatcher = $router->dispatch($method);
      
      // Bind params
      $this->push([
        'route' => $router->params()
      ]);

      // Get output
      $output = $this->app->load->callAction($dispatcher);

      // Set response body
      $output = (string) $output;
      return $this->app->response->withBody($output);
    }
}


/**
 * Instance of Application
 * 
 * @return self
*/
public static function instance(): self
{
    if(is_null(self::$instance))
    {
        self::$instance = new self();
    }
    return self::$instance;
}


/**
* Get container
* Dependency Injection Container
* 
* @return \JK\Container\ContainerInterface
*/
public function container()
{
    return (new \JK\DI\ContainerBuilder())
           ->build();
}



/**
  * Bind key and value in DIC 
  * [Dependency Injection Container]
  * 
  * @param string $key 
  * @param type $resolver 
  * @return void
*/
public function bind(string $key, $resolver)
{
     $this->app->registry($key, $resolver);
}


/**
 * Add data to container
 * 
 * @param array $data 
 * @return void
*/
public function push($data=[])
{
      $this->app->add($data);
}


/**
* Create new instance and inject params automatically
* Create new object 
* 
* @param string $name 
* @return object
*/
public function make(string $name, $arguments = null): object
{
     return $this->app->make($name, $arguments);
}


/**
* Set object as singleton
* 
* @param string $key 
* @param mixed|callable $resolver 
* @return void
*/
public function singleton(string $key, $resolver)
{
     $this->app->singleton($key, $resolver);
}



/**
 * Get resolver by key 
 * 
 * @param string $key 
 * @return mixed
*/
public function get(string $key)
{
    return $this->app->get($key);
}


/**
* Call automatically item from container
* 
* @param string $key 
* @return mixed
*/
public function __get($key)
{
   return $this->get($key);
}


/**
 * Notification
 * 
 * @return Debogger
*/
public function notify()
{
   return new \JK\Debug\Debogger($this->app);
}

}