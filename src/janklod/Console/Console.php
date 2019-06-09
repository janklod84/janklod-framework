<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\CommandInterface;
use JK\Foundation\Configuration;



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
 * 
 * @param string $file 
 * @return void
*/
public function __construct($file = null)
{
     $this->set_default_command();
     if($file && $path = realpath($file))
     {
         require($path);
     }

}


/**
 * Push commands configuration
 * 
 * @param array $commands 
 * @return void
*/
public static function addCommands($commands=[])
{
    if(!empty($commands))
    {
       self::$commands = array_merge(
          self::$commands, 
          $commands
      );
    }
}


/**
 * Add command
 * 
 * @param string | CommandInterface $command 
 * @return void
*/
public static function add($command)
{
    self::$commands[] = $command;
}


/**
 * Return all commands
 * @return array
*/
public static function commands()
{
     self::blockAccess();
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
     self::blockAccess();
     $signature = $input->argument(1);
     $message   = '';
     foreach(self::$commands as $command)
     {
         $commandInterface = $this->readCommand($command);
         if($commandInterface->argument() === $signature)
         {
             $commandInterface->execute($input, $output);
             $message = $output->message();
             break;
         }
     }
     return $message ?? 'No messages!';
}


/**
 * Block Access for not cli action
 * 
 * @return void
*/
private static function blockAccess()
{
  if(php_sapi_name() != 'cli')
  { die('Restricted'); } 
}


/**
 * Create command object
 * 
 * @param  $command
 * @return \JK\Console\CommandInterface
 */
private function readCommand($command): CommandInterface
{
    if($this->is_class($command))
    {
         $command = new $command();
    }

    if(!$this->is_command($command))
    {
        exit(
		sprintf('Sorry [%s] is not a valid command', $command)
		);   
    }
    return $command;
}

/**
 * Determine if given param is class
 * @param mixed $command 
 * @return bool
*/
private function is_class($command): bool
{
    return is_string($command) 
           && class_exists($command);
}


/**
 * Determine if given argument 
 * is instance of CommandInterface
 * @param mixed $command 
 * @return bool
*/
private function is_command($command): bool
{
   return $command instanceof CommandInterface;
}


/**
 * Set default commands
 * @return void
*/
private function set_default_command()
{
    $commands = require(
        realpath(__DIR__.'/DefaultCommand.php')
    );
    self::addCommands($commands);
}

}