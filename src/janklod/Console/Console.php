<?php 
namespace JK\Console;

use JK\Console\IO\InputArg;
use JK\Console\IO\Output;
use JK\Console\Command\Command;

/**
 * Class Console
 * 
 * @package JK\Console\Console
*/ 
class Console
{


/**
   * @var array $commands
   * @var string $configPath
*/
private static $commands = [];
  


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
     echo __FILE__;
     echo '<pre>';
     print_r(self::$commands);
     echo '</pre>';
}


/**
 * Add command
 * @param CommandInterface $command 
 * @param string $name
 * @param array $options
 * @return void
*/
public static function add(
CommandInterface $command, 
$name, 
$options = []
)
{
       self::$commands[$name] = $command;
       $command->options = $options;
}


  
/**
 * Execute command
 * @param string $input
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