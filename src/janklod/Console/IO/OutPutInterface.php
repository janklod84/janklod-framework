<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\OutputInterface
*/ 
interface OutputInterface
{
	/**
	 * Write message
     * 
	 * @param string $message 
	 * @return string
	*/
    public function writeln($message='');
    
    /**
     * Get message
     * @return string
    */
    public function message();
}