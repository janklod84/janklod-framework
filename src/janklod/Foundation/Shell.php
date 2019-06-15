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
    $this->file = Application::instance()->file;
    self::addCommands(Source::CONFIG['commands']);
	parent::__construct($this->file->to('routes/console.php'));
}

}