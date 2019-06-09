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
 * Determine if has command
 * 
 * @param string $name
 * @return bool
*/
public static function has($name)
{
    return isset(self::$commands[$name]);
}

/**
 * Get setted command
 * 
 * @param string $name
 * @return \JK\Console\CommandInterface
*/
public static function get($name): CommandInterface
{
     if(!self::has($name))
     {
         exit(
           sprintf('Sorry this command [%s] does not isset!', $name)
         );
     }
     return self::$commands[$name];
}

/**
 * Get all registred command
 * @return array
*/
public static function all()
{
    return self::$commands;
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
     self::get($signature)->execute($input, $output);
     return $output->message($signature);
}

}