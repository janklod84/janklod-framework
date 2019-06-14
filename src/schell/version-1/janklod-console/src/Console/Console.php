<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;

/**
 * Class Console [Excecute command]
 * 
 * @package JK\Console\Console
*/ 
class Console
{



/**
 * @var array $commands
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
}


/**
 * Add command
 * 
 * @param CommandInterface $command 
 * @return void
*/
public static function add(CommandInterface $command)
{
    self::$commands[] = $command;
}


/**
 * Run and execute commands
 * 
 * @param InputInterface $input
 * @param OutputInterface $output
 * @return string
*/
public function run(InputInterface $input, OutputInterface $output)
{
     if(php_sapi_name() != 'cli')
     { die('Restricted'); } 

     $signature = $input->argument(1);
     $message   = '';
     foreach(self::$commands as $command)
     {
         if($command->argument() === $signature)
         {
             $command->execute($input, $output);
             $message = $output->message();
             break;
         }
     }
     return $message ?? 'No messages!';
}

}