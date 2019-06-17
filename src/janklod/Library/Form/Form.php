<?php 
namespace JK\Library;


/**
 * class Form
 * 
 * @package JK\Library\Form
*/ 
class Form 
{
       
/**
* @var array $data
*/
protected $data = [];


/**
 * Construct
 * 
 * @param array $data 
 * @return void
*/
public function __construct($data=[])
{
	  $this->data = $data;
}

}