<?php 
namespace JK\Console\IO;


/**
 * @package JK\Console\IO\InputInterface 
*/ 
interface InputInterface
{

/**
* Input Arguments
* @param string $key
* @return mixed
*/
public function argument($key=null);

}