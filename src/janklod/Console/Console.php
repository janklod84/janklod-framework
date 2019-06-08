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
    /* if(php_sapi_name() != 'cli')
     { die('Restricted'); } */

     if($file && $path = realpath($file))
     {
         require($path);
     }
}


/**
 * Execute command
 * @param $input
 * @param output
 * @return mixed
*/
public function execute($input, $output=null)
{
     Command::get($input)->execute();
     // return $output->getMessage($input);
}

}