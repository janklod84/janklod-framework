<?php 
namespace JK\DI;


use JK\DI\Contracts\ContainerInterface;


/**
 * @package JK\DI\ServiceProvider
*/ 
abstract class ServiceProvider 
{
       
/**
* @var JK\DI\Contracts\ContainerInterface
*/
protected $app;


/**
* Constructor
* @param ContainerInterface $app 
* @return void
*/
public function __construct(ContainerInterface $app)
{
    $this->app = $app;
}


/**
* Do something before register
* @return mixed
*/
public function boot() {}


/**
* Do something after register
* @return mixed
*/
public function after(){}


/**
* Register provider
* @return void
*/
abstract public function register();

}