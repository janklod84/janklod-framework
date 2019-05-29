<?php 
namespace JK\Helper;

/**
 * @package JK\Helper\Register
*/ 
class Register
{
   

/**
* @var array $data
*/
private static $data = [];
private static $instance;


private function __construct(){}


/**
 * Get instance 
 * @return self
*/
public static function instance(): self
{
	 if(is_null(self::$instance))
	 {
	 	 self::$instance = new self();
	 }
	 return self::$instance;
}


/**
* register
* @param string $key 
* @param mixed $value 
* @return type
*/
public function set($key='', $value='')
{
    self::$data[$key] = $value;
}

/**
* register
* @param mixed $value 
* @return void
*/
public function push($key='', $value)
{
    self::$data[$key][] = $value;
}


/**
* Get data
* @param string $key 
* @return mixed
*/
public function get($key)
{
	if(isset(self::$data[$key]))
	{
	    return self::$data[$key];
	}
	return false;
}


/**
 * Return all registrated data
 * @return array
*/
public function all()
{
	return self::$data;
}


}