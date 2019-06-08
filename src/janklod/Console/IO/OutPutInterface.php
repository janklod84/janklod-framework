<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\OutputInterface
*/ 
interface OutputInterface
{
	/**
	 * Send out message
	 * @param string $message 
	 * @return string
	*/
    public function send($message='');
}