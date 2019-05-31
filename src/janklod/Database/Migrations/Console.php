<?php 
namespace JK\Console;


/**
 * @package JK\Console\Console
*/ 
class Console
{
	  
  /**
   * @var string $commandFile
  */
  private static $commandFile = '';

  
  /**
   * Constructor
   * @param string $path 
   * @return void
  */
  public function __construct($path='routes/console')
  {
      $commandFile  = trim($path, '/');
      $commandFile .= $path.'.php';
      self::$commandFile = $commandFile;
      if(!file_exists($commandFile))
      {
         exit(sprintf('Command File [ '. $commandFile . '] does not exist!')); 
      }
      require realpath($commandFile);
  }

  /**
   * Set base path config commands
   * @param string $commandFile 
   * @return void
  */
  public static function basePath($commandFile ='')
  {
         if(self::$commandFile === '')
         {
             self::$commandFile = $commandFile;
         }
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
   * add message
   * @param string $message 
   * @return 
  */
  public function addMessage($message='')
  {
         
  }
 
 
}