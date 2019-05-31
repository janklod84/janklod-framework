<?php 
namespace JK\Console;


/**
 * @package JK\Console\Console
*/ 
class Console
{
	  
  
  private static $configPath;
  private $invoker;
  
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
   * Constructor
   * @param \JK\Console\Command $invoker
   * @return void
  */
  public function addInvoker($invoker)
  {
  	    $this->invoker = $invoker;
  }

  
  /**
   * add input name
   * @param string $name 
   * @return 
  */
  public function addInput($name='')
  {
         
  }


  /**
   * add text
   * @param string $text 
   * @return 
  */
  public function addText($text='')
  {
         
  }


  /**
   * Execute all commands
   * @return mixed
  */
  public function execute()
  {
  	   // echo __METHOD__;
       
       /*
  	   $msg = "\n";

  	   for($i = 1; $i < 5; $i++)
  	   {
  	   	  $msg .= 'Bonjour Mr ' . $i . "\n";
  	   }
  	   return $msg;
  	   */
       $this->invoker->run();

  }
}