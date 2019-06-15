<?php 
namespace JK\Foundation;


use JK\Http\RequestInterface;
use JK\Http\ResponseInterface;
use JK\Debug\Debogger;
use JK\FileSystem\File;
use \Config;


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

   
  /*
   @require_once __DIR__.'/../index.php';
   exit('End testing ...');
   */
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
 * Inialize all services of application
 * 
 * @return void
*/
public function initialize()
{
   (new Initialize($this->app))
   ->run();
}



/**
  * Break Point of Application
  * 
  * @return mixed
*/
public function run()
{   
 if(!$this->request->is('cli'))
 {
   // Run all services and modules
   $this->initialize();
  
   // Call method terminate
   $this->terminate($this->request, $this->response);
 }
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
* [ex: Application::instance()->make(Blog::class) ]
* $obj = $this->app->make(
* 'JanKlod\\Test', 
* ['id' => 1, 'slug' => 'jean'
* ]);
* $this->make('JanKlod\\Test', [1, jean']);
* $this->make('JanKlod\\Test');
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
 * Handle request
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @return mixed
*/
public function handle(RequestInterface $request)
{
     $method     = $request->method();
     $dispatcher = $this->router->run($method);
     $callback   = $dispatcher->getCallback();
     $matches    = $dispatcher->getMatches();
     return $this->load->callAction($callback, $matches);
}


/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param JK\Http\ResponseInterface $response 
 * @return void
*/
public function terminate(
RequestInterface $request, 
ResponseInterface $response
)
{
   $output = (string) $this->handle($request);
   $response->setBody($output);
   $response->send(); 
   
   // show message
   $this->notify();
}


/**
 * Show messages
 * 
 * @return void
*/
private function notify()
{
   $debogger = new Debogger($this->app);
   $debogger->output(\Config::get('app.debug'));
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