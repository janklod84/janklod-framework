<?php 
namespace JK\Console;


/**
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
   * @return void
  */
  public static function add(CommandInterface $command)
  {
         self::$commands[] = $command;
  }

    
  /**
   * Execute command
   * @return mixed
  */
  public function execute()
  {
	   foreach(self::$commands as $command)
	   {
          // put here condition, but all commands will be executed
	   	    $command->execute();
	   }
  }

   
  /**
   * Roolback command
   * @return void
  */
  public function undo(){}

  
}