<?php 
namespace JK\Foundation\Console;

use JK\Console\Console;
use JK\Foundation\App;
use JK\Foundation\Source;



/**
 * @package JK\Foundation\Console\Shell 
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
    $this->file = App::instance()->file;
    self::addCommands(Source::CONFIG['commands']);
    $this->file->call('routes/console.php');
    parent::__construct();
  }
}



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