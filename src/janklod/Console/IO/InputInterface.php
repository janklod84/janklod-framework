<?php 
namespace JK\Console\IO;

use JK\Http\Contracts\ServerRequestInterface;


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