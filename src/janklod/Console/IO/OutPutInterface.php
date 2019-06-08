<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\OutputInterface
*/ 
interface OutputInterface
{
	/**
	 * Write out message
	 * @param string $message 
	 * @return string
	*/
    public function write($message='');
    
    /**
     * Get message
     * @return string
    */
    public function message();
}