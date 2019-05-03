<?php 
namespace JK\Behaviors\Command;


/**
 * @package JK\Behaviors\Command\CommandInterface
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