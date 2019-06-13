<?php 
namespace JK\Foundation;

use JK\Console\Console;


/**
 * @package JK\Foundation\Schedule 
*/ 
class Schedule extends Console 
{

/**
 * @var string $name
 * @var \JK\FileSystem\File $file
*/
// protected $name = 'schedule';
protected $file;



/**
 * Constructor
 * 
 * @return void
 */
public function __construct()
{
    $this->file = Application::instance()->file;

    $this->set_base_command(
    	Source::CONFIG['commands']
    );
	parent::__construct($this->file->to('routes/console.php'));
}

}