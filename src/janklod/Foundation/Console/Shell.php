<?php 
namespace JK\Foundation;

use JK\Console\Console;


/**
 * @package JK\Foundation\Shell 
*/ 
class Shell extends Console 
{

/**
 * @var string $name
 * @var \JK\FileSystem\File $file
*/
// protected $name = 'shell';
protected $file;



/**
 * Constructor
 * 
 * @return void
 */
public function __construct()
{
  if(php_sapi_name() == 'cli') 
  {
    class_alias(__CLASS__, 'Shell');
    $this->file = Application::instance()->file;
    self::addCommands(Source::CONFIG['commands']);
    $this->file->call('routes/console.php');
    parent::__construct();
  }
}


/**
 * Here load commands and require
 * 
 * @return void
*/
public function commands() {}


/**
 * Excecute command
 * 
 * @param string $signature 
 * @param \Closure $closure 
 * @return void
*/
public static function command($signature, \Closure $closure)
{
     /* call_user_func($closure); */
}

}