<?php 
namespace JK\Foundation;


use JK\Http\Contracts\RequestInterface;
use JK\Http\Contracts\ResponseInterface;

use JK\FileSystem\File;
use JK\Config\Config;
use JK\Exception\Error;
use JK\Exception\Support\WhoopsAdapter;
use JK\Routing\Router;



/**
 * Application
 * 
 * @package JK\Foundation\Application
*/ 
final class Application
{

         
/**
 * Instance of Application
 * @var JK\Foundation\Application
*/
private static $instance;


/**
 * Container Dependency Injection Interface
 * @var  JK\DI\Contracts\ContainerInterface $app
*/
private $app;


/**
 * @var string $root  [ Application root ]
*/
private $root;


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
  * @param string $root
  * @return void
*/
private function __construct($root)
{
   // Get container
   $this->app = $this->container();
   
   // root application
   $this->root = $root;

   // bind file in container
   $this->bind('file', function () {
      return $this->make(File::class, [$this->root]);
   });
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
   define('JKSTART', microtime(true));
   
   // Load all configuration
   $path = $this->app->file->to('app/config/*');
   Config::map($path);

   // Initialize all services [ Bootstrap of application ]
   (new Initialize($this->app))->run();

}


/**
 * Handle Application
 * 
 * @param RequestInterface $request 
 * @return 
 */
public function handle(RequestInterface $request)
{
   if(!$request->is('cli'))
   {
      // Get URL
      $url = $request->get('url');

      // Instance de Router
      $router = $this->make(Router::class, [$url]);

      // Get request method
      $method = $request->method();

      // Get dispatcher
      $dispatcher = $router->dispatch($method);

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
 * Root of application
 * 
 * @return string
*/
public function root()
{
    return $this->root;
}



/**
 * Get one times instance of Application
 * [ Using pattern Singleton ]
 * 
 * Ex: $app = Application::instance();
 * 
 * @param  string $root
 * @return self
*/
public static function instance($root = null): self
{
    if(is_null(self::$instance))
    {
        self::$instance = new self($root);
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
 * Storage params for pretty print
 * 
 * @return void
*/
private function bindParams()
{
    /*
    $this->push([
      'current.route'   => $this->router->params(),
      'current.queries' => '', //\JK\ORM\Q::queries(),
      'config' => '', // Config::all()
     ]);
     */

}

}