<?php 
namespace JK\ORM\Adapters;


use JK\ORM\Contracts\DriverInterface;


/**
 * @package JK\ORM\Adapters\DriverAdapter 
*/ 
class DriverAdapter 
{
     

/**
 * @var DriverInterface
*/
protected $driver;


/**
* Construct
* 
* @param DriverInterface $driver 
* @return void
*/
public function __construct(DriverInterface $driver)
{
	   $this->driver = $driver;
}



/**
 * Get connection
 * 
 * @return 
*/
public function connect()
{
    return $this->driver->connect();
}


/**
 * Get dsn
 * 
 * @return string
*/
public function dsn()
{
	 return $this->driver->dsn();
}

}