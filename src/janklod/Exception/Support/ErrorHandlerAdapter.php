<?php 
namespace JK\Exception\Support;


use JK\Exception\Contracts\ErrorInterface;
use JK\Exception\Errors\ErrorHandler;


/**
 * @package JK\Exception\Support\ErrorHandlerAdapter
*/ 
class ErrorHandlerAdapter implements ErrorInterface
{

/**
* @var ErrorHandler $error
*/
private $error;


/**
* Constructor
* 
* @return void
*/
public function __construct()
{
    $this->error = new ErrorHandler();
}


/**
 * Set Handler
 * 
 * @param mixed $error 
 * @return void
*/
public function setHandler()
{
   $this->error->setHandlers();
}

/**
 * Register
 * 
 * @return void
*/
public function register() {}

}