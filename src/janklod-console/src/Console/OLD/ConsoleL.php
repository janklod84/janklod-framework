<?php 
namespace JK\Console;

use JK\Console\IO\InputArg;
use JK\Console\IO\Output;
use JK\Console\Command\Command;

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
     echo __FILE__;
     echo '<pre>';
     print_r(self::$commands);
     echo '</pre>';
}


/**
 * Execute command
 * @param $input
 * @param output
 * @return mixed
*/
public function execute($input, $output=null)
{
    // $input->argument(1) [$argv[1]]
    if(isset(self::$commands[$input]))
    {
        $msg = self::$commands[$input]->execute();

        // return ! $output ? $output->message($msg) : 'No messages';
    }
}

}