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
  private static $configPath;

  
  /**
   * Constructor
   * @param string $path 
   * @return void
  */
  public function __construct($path='routes/console')
  {
      $commandFile  = trim($path, '/');
      $commandFile .= $path.'.php';
      if(!file_exists($commandFile))
      {
         exit(sprintf('Command File [ '. $commandFile . '] does not exist!')); 
      }
      require realpath($commandFile);
  }

  /**
   * Set base path config commands
   * @param string $configPath 
   * @return string
  */
  public static function basePath($configPath='')
  {
         self::$configPath = $configPath;
  }


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

  
}