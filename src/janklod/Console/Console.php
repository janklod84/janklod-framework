<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\CommandInterface;


use \ReflectionClass;


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
public function __construct() { }


/**
 * Add commands from file or array
 * 
 * @param string|array $parsed
 * @return void
*/
public static function addCommands($parsed=null)
{
   $commands = (array) $parsed;
   if(is_string($parsed) && is_file($parsed))
   {
       $commands = require(
       realpath($parsed)
       );
   }
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
 * Get current console name
 * 
 * @return void
*/
public function name()
{
   return $this->name;
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
 * Excecute command
 * 
 * @param string $compile 
 * @param InputInterface $input 
 * @param OutputInterface $output 
 * @return void
*/
public function execute($compile='', InputInterface $input, OutputInterface $output)
{
     // block access no cli request
     self::blockAccess();
     
     // get head 
     $this->blank_head();

     // Make sure input name file matches
     if($compile !== $this->name)
     {
         exit(
          sprintf(
           'Sorry command [ %s ] does not match console file name [ %s ]', 
           $input->argument(0), 
           $this->name
          )
         );
     }
     
     // Get Help
     $first = $input->argument(1);
     if($first === '--help' || $first === '--h')
     {
         exit($this->help());
     }
     
     // execution processing
     return $this->process($input, $output);
}


/**
 * Run and execute commands
 * 
 * @param \JK\Console\IO\InputInterface $input 
 * @param \JK\Console\IO\OutputInterface $output 
 * 
 * @return string
*/
public function run(InputInterface $input, OutputInterface $output)
{
    return $this->execute($input->argument(0), $input, $output);
}


/**
 * Get Help
 * 
 * cmd>php console --help|--h
 * @return string
*/
public function help()
{
    $output = 'HELP COMMANDS:'."\n\n";
    foreach(self::$commands as $command)
    {
       $cmd = $this->createCommand($command);
       $output .= $cmd->signature();
       $output .= "\n\t" . join("\n\t", $cmd->description()) ."\n";
    }
    return $output;
}


/**
 * Execution process
 * 
 * @param \JK\Console\IO\InputInterface $input 
 * @param \JK\Console\IO\OutputInterface $output 
 * 
 * @return string
 */
protected function process($input, $output)
{
   $message = '';
   foreach(self::$commands as $command)
   {
        $cmd = $this->createCommand($command, [$input, $output]);
        $argument = '#^'. $input->argument(1) . '$#';
        $signature = $cmd->signature();

        if(preg_match($argument, $signature))
        {
           $cmd->execute();
           $output->writeln($this->end_msg());
           return $output->message() ?? 'No messages!';
        }
   }
   exit("\t".'No matched command!'. "\n");
}


/**
 * Create command object
 * 
 * @param  string $command
 * @param  array  $arguments
 * @return \JK\Console\CommandInterface
 */
protected function createCommand($command, $arguments=[]): CommandInterface
{
    if($this->is_class($command))
    {
         $reflection = new ReflectionClass($command);

         $command = $reflection->newInstanceArgs($arguments);
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
    return is_string($command) && class_exists($command);
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



/**
 * Show end message
 * 
 * @return string
 */
protected function end_msg()
{
    $times = round(microtime(true) - JKSTART, 5);
    $html  = "\n";
    $html .= 'End execution shell script'. "\n";
    $html .= 'Times execution ( ' . $times . ' ) seconds.';
    return $html;
}

/**
 * Header
 * 
 * @param string $message 
 * @return void
*/
protected function blank_head($message='')
{
   $html  = "\n";
   $html  = '+-----------------+-----------------+'."\n"; 
   $html .= '+----  JK Framework Console --------+'."\n"; 
   $html .= '+-----------------+-----------------+'."\n"; 
   $html .= "\n";
   echo $html;
}


}