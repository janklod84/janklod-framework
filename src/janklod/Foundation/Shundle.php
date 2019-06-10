<?php 
namespace JK\Foundation;

use JK\Console\Console;


/**
 * @package JK\Foundation\Shundle 
*/ 
class Shundle extends Console 
{

// protected $name = 'shundle';

/**
 * Constructor
 * 
 * @param string $file 
 * @return void
 */
public function __construct($file='')
{
	/*
	$this->set_base_command(
      __DIR__.'/commands.php'
    );
    */

    $this->set_base_command(
    	Configuration::SRC['commands']
    );
	parent::__construct($file);
}

}