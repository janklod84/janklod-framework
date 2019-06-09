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
 * Add new Lines
 * 
 * @param int $times 
 * @return string
*/
public function newLine($times=1)
{
   for($i=0; $i < $times; $i++)
   {
        echo "\n";
   }
}

/**
* Get message
* 
* @return string
*/
public function message()
{
   return "\n". join("\n", $this->message) . "\n";
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