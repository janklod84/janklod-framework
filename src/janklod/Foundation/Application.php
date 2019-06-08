<?php 
namespace JK\Foundation;


use JK\DI\ContainerBuilder;
use JK\FileSystem\File;
use JK\Config\Config;
use JK\Routing\Dispatcher;
use JK\Database\DatabaseManager;


/**
 * Application
 * @package JK\Application
*/ 
final class Application 
{

         
/**
 * Instance of Application
 * @var JK\Application
*/
private static $instance;


/**
 * Container Dependency Injection Interface
 * @var  JK\Container\ContainerInterface $app
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
  * @param string $root
  * @return void
*/
private function __construct($root)
{
   $this->app = $this->getContainer();
   $this->bind('file', new File($root));
}



/**
 * Inialize all services of application
 * @return void
*/
public function initialize()
{
   (new Initialize($this->app))
   ->run();
}


/**
 * Session start
 * @return void
*/
public function session()
{
    Session::start();
}


/**
* Initialize all functions
* @return void
*/
public function loadFunctions()
{
   Bootstrap::functions();
}

/**
* Initialize all alias
* @return void
*/
public function loadAlias()
{
   Bootstrap::alias();
}


/**
* Initialize all services providers
* @return void
*/
public function loadProviders()
{
   Bootstrap::providers($this->app);
}


/**
 * Handler
 * @param \JK\Http\RequestInterface  $request 
 * @return \JK\Http\ResponseInterface 
 */
public function handle(
RequestInterface $request
): ResponseInterface
{
     //
}


/**
 * Synthese request and response
 * 
 * @param RequestInterface $request 
 * @param ResponseInterface $response 
 * @return 
*/
public function terminate(
RequestInterface $request, 
ResponseInterface $response
)
{

}


/**
  * Break Point of Application
  * @return mixed
*/
public function run()
{   
     // Run all services
     $this->initialize();

     /*
     $requestMethod = $this->request->method();
     $dispatcher = $this->router->dispatch($requestMethod);
     if(is_null($dispatcher))
     {
         $dispatcher = new Dispatcher('NotFoundController@page404');
     }
     $this->bindParams();
     $callback   = $dispatcher->getCallback();
     $matches    = $dispatcher->getMatches();
     $this->load->callAction($callback, $matches);

     /* \Q::output(); 
     */
     
}


/**
 * Get one times instance of Application
 * Using pattern Singleton
 * @param  string $root
 * @return JK\Application [ instance of application ]
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
* @return \JK\Container\ContainerInterface
*/
public function getContainer()
{
    return (new ContainerBuilder())
           ->build();
}



/**
  * Bind key and value in DIC [Dependency Injection Container]
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
 * @param array $data 
 * @return void
*/
public function push($data=[])
{
      $this->app->merge($data);
}


/**
* Create new instance and inject params automatically
* Create new object [ex: (new \JK\Application())->make(Blog::class) ]
* $obj = $this->app->make('JanKlod\\Test', ['id' => 1, 'slug' => 'jean']);
* $this->make('JanKlod\\Test', [1, jean']);
* $this->make('JanKlod\\Test');
* 
* @param string $name 
* @return object
*/
public function make(string $name, $arguments = null): object
{
     return $this->app->create($name, $arguments);
}


/**
* Set object as singleton
* @param string $key 
* @param mixed|callable $resolver 
* @return void
*/
public function singleton(string $key, $resolver)
{
     $this->app->singleton($key, $resolver);
}



/**
 * get resolver by key 
 * @param string $key 
 * @return mixed
*/
public function get(string $key)
{
    return $this->app->get($key);
}


/**
* Call automatically item from container
* @param string $key 
* @return mixed
*/
public function __get($key)
{
   return $this->get($key);
}

/**
 * Storage params for pretty print
 * @return void
*/
private function bindParams()
{
    $this->push([
      'current.route'   => $this->router->params(),
      'current.queries' => '', //\JK\ORM\Q::queries(),
      'config' => '', // Config::all()
     ]);

}

}