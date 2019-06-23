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
 * @var array $commands    [ Container all commands ]
 * @var string $compile    [ Name of file to execute ]
 * @var string $options    [ Options console ]
 * @var array  $register   [ Command Register ]
 * @var string $help       [ Help output ]
*/
protected static $commands = [];
protected $compile   = 'console';
protected $options   = [];
protected $register  = [];
protected $help      = 'HELP COMMANDS:'."\n\n";

/**
 * Constructor
 *  
 * @param string $compile
 * @return void
*/
public function __construct($compile='') 
{
     if($compile !== '')
     {
        $this->compile = $compile;
     }
}


/**
 * Load command
 * 
 * Ex: $this->load(__DIR__.'/Commands.php');
 * 
 * @param string $command_path
 * @return void
*/
protected function load(string $command_path)
{
   if(is_string($command_path) && is_file($command_path))
   {
       $this->addCommands(
         require(realpath($command_path))
       );
   }
}




/**
 * Add commands from file or array
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
 * 
 * @return array
*/
public static function getCommands()
{
     return self::$commands;
}



/**
 * Get current console name
 * 
 * @return void
*/
public function name()
{
   return $this->compile;
}



/**
 * Excecute command
 * 
 * @param InputInterface $input 
 * @param OutputInterface $output 
 * @return mixed
*/
public function execute(InputInterface $input, OutputInterface $output)
{
     // block access no cli request
     if(php_sapi_name() != 'cli') { die('Restricted'); } 

     // registration commands by signature
     foreach(self::$commands as $command)
     {
          $cmd = $this->createObjectCommand($command, [$input, $output]);
          $this->register[$cmd->signature()] = $cmd;
          $this->help .= $cmd->signature() . "\n\t" 
                         . join("\n\t", $cmd->description()) ."\n";
     }

     // get head 
     $this->blank_head();

     // Make sure input name file matches
     if($input->argument(0) !== $this->compile)
     {
         exit(
          sprintf(
           'Sorry command [ %s ] does not match console file name [ %s ]', 
           $input->argument(0), 
           $this->compile
          )
         );
     }
     

     // execution processing
     return $this->process($input, $output);
}


/**
 * Get Help
 * 
 * cmd>php console --help|--h
 * @return string
*/
public function help()
{
    exit($this->help);
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
   // Get first argument
   $argument = $input->argument(1);
   
    if($argument === '--help' || $argument === '--h')
    {
        $this->help();
    }
     
     // Get commands list
    if($argument === '--commands')
    {
         print_r(self::$commands);
         exit;     
    }
    
    // Execute command
    if(isset($this->register[$argument]))
    {
         $command = $this->register[$argument];
         $command->execute();
         $output->writeln($this->end_msg());  
         return $output->message();
    }else{

        echo 'Invalid Command [ ' . $argument . ' ]'. "\n\n";
        $this->help();
     }
     // return false;
}


/**
 * Create command object
 * 
 * @param  string $command [ Command Name ]
 * @param  array  $arguments
 * @return \JK\Console\CommandInterface
 */
protected function createObjectCommand($command, $arguments=[]): CommandInterface
{
    if($this->is_class($command))
    {
       $reflection = new ReflectionClass($command);

       if(! $command = $reflection->newInstanceArgs($arguments))
       {
           exit('Can not get new Instance of '. $reflection->getName());
       }

    }else{
        exit('Sorry class ['. $command .'] does not exist!');
    }

    if(! $this->is_command($command))
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