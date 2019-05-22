<?php 
namespace JK\Http\Requests;


use JK\Collections\Collection;
use JK\Helper\Common;


/**
 * @package JK\Http\Requests\Input
*/ 
class Input 
{


/**
* @var array $data
*/
private $collection;


/**
* Constructor
* @param array $data 
* @return void
*/
public function __construct($data = [])
{
     $this->collection = new Collection($data);
}


/**
* Get item from $_COOKIE
* @param string $key 
* @return mixed
*/
public function get($key = null)
{
	   $result = $this->parameters();
     if(!is_null($key))
     {
     	  $result = $this->collection->get($key);
     }
     return $result;
}


/**
* Get all input data
* @return mixed
*/
public function parameters()
{
	  return $this->collection->all();
}


/**
* Sanitize input data
* 
* @param array $data
* @param string $input
* @return mixed
*/
public function sanitize($input = null)
{
    if(is_null($input))
    {
        $data = $this->parameters();
      	return $this->populated($data);
    }
    
    $sanitized = '';
    if(isset($data[$input]))
    {
        $sanitized = trim(Common::sanitize($data[$input]));
    }
    return $sanitized;
}


/**
 * Populate and sanitize full data
 * @param array $data 
 * @return mixed
 */
public function populated($data=[])
{
    $populated = [];
    foreach($data as $field => $value)
    {
          $populated[$field] = trim(Common::sanitize($value));
    }
    return $populated;
}


}