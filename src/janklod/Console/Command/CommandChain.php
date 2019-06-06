<?php 
namespace JK\Console;


/**
 * Class register commands
 * @package JK\Console\CommandChain 
*/ 
class CommandChain 
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
	   // foreach(self::$commands as $type => $command)
	   // {
    //       // put here one condition before execution
	   // 	    $command->execute();
	   // }

     if(isset(self::$commands[$input]))
     {
           self::$commands[$input]->execute();
     }
  }

  

  
}