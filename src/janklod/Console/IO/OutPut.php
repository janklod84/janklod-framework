<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\Output 
*/ 
class Output implements OutputInterface
{


/**
 * @var string $message
*/
private $message = [];


/**
* Write output message
* 
* @param string $input 
* @param string $message 
* @return string
*/
public function write($input, $message='')
{
    $this->message[$input][] = $message;
}
    
/**
* Get message
* 
* @param string $input
* @return string
*/
public function message($input)
{
   return join(' ', $this->message[$input]);
}

}