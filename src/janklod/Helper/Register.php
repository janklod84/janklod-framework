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
* set item
* @param string $key 
* @param mixed $value 
* @return type
*/
public function set($key='', $value='')
{
    self::$data[$key] = $value;
}

/**
* push data in container
* @param mixed $value 
* @return void
*/
public function push($value)
{
    array_push(self::$data, $value);
}


/**
* merge data
* @param array $data
* @return void
*/
public function merge($data = [])
{
    self::$data = array_merge(self::$data, $data);
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