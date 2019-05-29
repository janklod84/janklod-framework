<?php 
namespace JK\Http\Requests;


/**
 * @package JK\Http\Requests\Input
*/ 
class Input 
{


/**
* @var array $data
*/
private $data;



/**
* Constructor
* @param array $data 
* @return void
*/
public function __construct($data = [])
{
      $this->data = $data;
}

/**
* Get item from $_COOKIE
* @param string $key 
* @return mixed
*/
public function get($key = null, $sanitize = false)
{
  if($sanitize === true) 
  { return $this->clean($key); }

  if(!is_null($key))
  {
 	   return $this->findItem($key);
  } 
}


/**
* Get all input data
* @return mixed
*/
public function parameters()
{
  return $this->data ?? [];
}


/**
 * Determine if has item in data
 * @param string $key 
 * @return bool
 */
public function hasItem($key): bool
{
    return isset($this->data[$key]);
}


/**
 * Retrieve item data
 * @param string $key 
 * @return mixed
*/
public function findItem($key)
{
    if($this->hasItem($key))
    {
        return $this->data[$key];
    }
    return null;
}


/**
* Sanitize input data
* 
* @param string $input
* @return mixed
*/
public function clean($input = null)
{
    if(is_null($input))
    {
      	return $this->populated();
    }
    
    $sanitized = '';
    if(isset($this->data[$input]))
    {
        $sanitized = trim(
          self::sanitize($this->data[$input])
        );
    }
    return $sanitized;
}


/**
 * Populate and sanitize current data
 * @return mixed
*/
public function populated()
{
    $populated = [];
    foreach($this->data as $field => $value)
    {
          $populated[$field] = trim(self::sanitize($value));
    }
    return $populated;
}


/**
* Sanitize input data 
* 
* @param string $input
* @return 
*/
public static function sanitize($input)
{
    return htmlentities($input, ENT_QUOTES, 'UTF-8');
}

}