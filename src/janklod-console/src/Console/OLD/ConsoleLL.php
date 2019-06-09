<?php 
namespace JK\Console;

use JK\Console\IO\InputArg;
use JK\Console\IO\Output;

/**
 * Class Console [Excecute command]
 * 
 * @package JK\Console\Console
*/ 
class Console
{

 
/**
 * constructor
 * @param string $file 
 * @return void
*/
public function __construct($file = null)
{
     if($file && $path = realpath($file))
     {
         require($path);
     }
}


/**
 * Execute command
 * @param $input
 * @return mixed
*/
public function execute($input)
{
     if(php_sapi_name() != 'cli')
     { die('Restricted'); } 

     Command::get($input)->execute();
     // return $output->getMessage($input);
}

}