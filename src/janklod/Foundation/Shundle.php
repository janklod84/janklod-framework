<?php 
namespace JK\Foundation;

use JK\Console\Console;


/**
 * @package JK\Foundation\Shundle 
*/ 
class Shundle extends Console 
{

/**
 * Constructor
 * 
 * @param string $file 
 * @return void
 */
public function __construct($file='')
{
	$this->set_base_command(
      __DIR__.'/commands.php'
    );
	parent::__construct($file);
}

}