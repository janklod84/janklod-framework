<?php 
namespace JK\Behaviors;


/**
 * @package JK\Behaviors\CommandInterface
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