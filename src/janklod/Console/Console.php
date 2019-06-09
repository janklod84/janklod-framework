<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\CommandInterface;



/**
 * Class Console [Excecute command]
 * 
 * @package JK\Console\Console
*/ 
class Console implements ConsoleInterface
{


/**
 * @var array $commands [ Container all commands ]
 * @var string $name    [ Name of file to execute ]
*/
protected static $commands = [];
protected $name = 'console';

/**
 * constructor
 * 
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
 * Set base commands
 *
 * @return void
*/
public function set_base_command($parsed=null)
{
   $commands = $parsed;
   if(is_file($parsed))
   {
       $commands = require(
       realpath($parsed)
       );
   }
   self::addCommands($commands);
}


/**
 * Set name of file to execute
 * 
 * @param string $name 
 * @return void
*/
public function name($name)
{
     $this->name = $name;
}



/**
 * Run and execute commands
 * 
 * @param InputInterface $input
 * @param OutputInterface $output
 * 
 * @return string
*/
public function run(InputInterface $input, OutputInterface $output)
{
  self::blockAccess();
  $message = '';
  if($input->argument(0) === $this->name)
  {
      foreach(self::$commands as $command)
      {
         if($commandInterface = $this->readCommand($command))
         {
            $commandInterface->execute($input, $output);
            $message = $output->message();
         }
     }
     return $message ?? 'No messages!';
  }
  
}


/**
 * Block Access for not cli action
 * 
 * @return void
*/
protected static function blockAccess()
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
protected function readCommand($command): CommandInterface
{
    if($this->is_class($command))
    {
         $command = new $command();
    }

    if(!$this->is_command($command))
    {
        exit(
		     sprintf(
          'Sorry [%s] is not implements CommandInterface', 
          $command
        )
		   );   
    }
    return $command;
}

/**
 * Determine if given param is class
 * @param mixed $command 
 * @return bool
*/
protected function is_class($command): bool
{
    return is_string($command) 
           && class_exists($command);
}


/**
 * Determine if given argument 
 * is instance of CommandInterface
 * 
 * @param mixed $command 
 * @return bool
*/
protected function is_command($command): bool
{
   return $command instanceof CommandInterface;
}


}