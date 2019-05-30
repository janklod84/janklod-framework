<?php 
namespace JK\Console;


/**
 * @package JK\Console\Command 
*/ 
class Command 
{
     
      /**
       * @var array $commands
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
	  	   foreach($this->commands as $command)
	  	   {
	  	   	    $command->execute();
	  	   }
	  }
}