<?php 
namespace JK\Console;


/**
 * @package JK\Console\CommandInterface
*/ 
interface CommandInterface 
{

	  /**
	   * Execute command
	   * @return mixed
	  */
	  public function execute();
      

      /**
       * Roolback command
       * @return void
      */
	  public function undo();
}