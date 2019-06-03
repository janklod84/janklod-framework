<?php 
namespace JK\Database\Migrations;


/**
 * @package JK\Database\Migrations\Migration 
*/ 
abstract class Migration 
{

	   /**
	    * Method up
	    * @return void
	   */
	   abstract public function up();
	   
       /**
        * Method down
        * @return void
       */
	   abstract public function drop();
}