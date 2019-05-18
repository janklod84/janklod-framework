<?php 
namespace JK\Http;


/**
 * @package JK\Http\Session 
*/ 
class Session 
{
      
/**
* @var array $sessions
*/
private $sessions = [];


/**
* Constructor
* @param array $sessions 
* @return void
*/
public function __construct($sessions = [])
{
    $this->sessions = $sessions ?: $_SESSION;
}


/**
* Put item in session
* @param string $name 
* @param mixed $value 
* @return void
*/
public function put($name, $value)
{

}


/**
* Determine if has item in $_SESSION
* @param string $key 
* @return bool
*/
public function has($key): bool
{

}


/**
* Get item from $_SESSION
* @param string $key 
* @return mixed
*/
public function get($key)
{

}


/**
* Get all item from $_SESSION
* @return array
*/
public function all()
{
	  
}
}