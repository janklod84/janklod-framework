<?php 
namespace JK\Service;


use JK\DI\ContainerInterface;


/**
 * @package JK\Service\ServiceProvider
*/ 
abstract class ServiceProvider 
{
       
/**
* @var \JK\DI\ContainerInterface
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