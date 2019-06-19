<?php 
namespace JK\Exception\Support;


use JK\Exception\Contracts\ErrorInterface;
use \Whoops\Handler\PrettyPageHandler;


/**
 * @package JK\Exception\Support\WhoopsAdapter
*/ 
class WhoopsAdapter implements ErrorInterface
{

/**
* @var Whoops\Run $error
*/
private $error;


/**
* Constructor
* 
* @return void
*/
public function __construct()
{
    $this->error = new \Whoops\Run();
}


/**
 * Set Handler
 * 
 * @return void
*/
public function setHandler()
{
   $this->error->pushHandler(new PrettyPageHandler());
}

/**
 * Register
 * 
 * @return void
*/
public function register()
{
    $this->error->register();
}

}