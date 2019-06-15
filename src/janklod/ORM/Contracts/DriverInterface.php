<?php 
namespace JK\ORM\Contracts;


/**
 * @package JK\ORM\Contracts\DriverInterface
*/ 
interface DriverInterface
{
/**
* Connect  to PDO 
* 
* @return \PDO
*/
public function connect();

/**
* Get DSN
* 
* @return string
*/
public function dsn();
}