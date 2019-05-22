<?php 
namespace JK\Http\Requests;


use JK\Collections\Collection;


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
      	$populated = [];
        $data = $this->parameters();
      	foreach($data as $field => $value)
      	{
              $populated[$field] = trim(Sanitize::input($value));
      	}
      	return $populated;
    }

    return isset($data[$input]) ? trim(Sanitize::input($data[$input])) : '';
}

}