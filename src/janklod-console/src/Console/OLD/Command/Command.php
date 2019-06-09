<?php 
namespace JK\Console;


/**
 * Class register commands [ Command Chain ]
 * @package JK\Console\Command
*/ 
class Command
{
     
  /**
   * @var array $commands
   * @var string $configPath
  */
  private static $commands = [];
  

  /**
   * Add command
   * @param CommandInterface $command 
   * @param string $name
   * @param array $options
   * @return void
  */
  public static function add(CommandInterface $command, $name, $options = [])
  {
         self::$commands[$name] = $command;
         $command->options = $options;
  }
  

    
  /**
   * Execute command
   * @param string $input
   * @param array  $arguments
   * @return mixed
  */
  public function execute($input, $arguments = [])
  {
	  foreach(self::$commands as $type => $command)
	  {
          
	  }

     if(isset(self::$commands[$input]))
     {
           self::$commands[$input]->execute();
     }
  }

  

  
}