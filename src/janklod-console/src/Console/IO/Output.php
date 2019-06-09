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
public function writeln($message='')
{
    $this->message[] = $message;
}
    
/**
* Get message
* 
* @return string
*/
public function message()
{
   return join(' ', $this->message);
}


/**
 * Remove all initialized variables
 * @return void
*/
private function remove()
{
	$this->message = [];
}

}