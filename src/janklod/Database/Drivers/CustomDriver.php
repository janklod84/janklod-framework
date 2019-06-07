<?php 
namespace JK\Database\Drivers;


use \PDO;


/**
 * @package JK\Database\Drivers\CustomDriver 
*/ 
abstract class CustomDriver 
{


/**
 * @var array $options  [ Default Optional params for PDO ]
 * @var array $config   [ Config array ]
*/
protected $options = [
   PDO::ATTR_PERSISTENT => false,
   PDO::ATTR_EMULATE_PREPARES => 0, 
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

protected $config;

/**
 * Constructor
 * @param array $config 
 * @return void
*/
public function __construct($config=[])
{
     $this->config = $config;
}


/**
 * Connect to PDO
 * @return \PDO
*/
abstract public function connect();


/**
 * Get DSN
 * @return string
*/
abstract public function dsn();


/**
 * Get PDO
 * @param string $dsn
 * @param string $username
 * @param string $password
 * @return \PDO
*/
public function pdo($dsn='', $username, $password)
{
	 return new PDO($dsn, $username, $password, $this->options());
}


/**
 * Get options
 * @param array $options 
 * @return void
*/
public function options()
{
    if($this->config('options'))
    {
    	$this->options = array_merge(
    		$this->options, 
    		$this->config('options')
       ); 
    }
    return $this->options;
}


/**
 * Get config item
 * @param string $item 
 * @return mixed
 * @throws \Exception 
*/
public function config($item)
{
   if(!isset($this->config[$item]))
   {
       throw new \Exception("Config item [$item] is not setted", 404);
   }
   return $this->config[$item];
}

}