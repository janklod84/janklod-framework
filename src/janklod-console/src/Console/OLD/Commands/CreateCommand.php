<?php 
namespace JK\Console\Commands;

use JK\Console\CommandInterface;

/**
 * @package JK\Console\Commands\CreateCommand 
*/ 
class CreateCommand implements CommandInterface
{
     
     public $name = 'create';
     public $options = [];

	 public function execute()
	 {
	 	 die('Привет консоль : '. __METHOD__);
	 }

	 public function setOptions($options)
	 {
	 	 $this->options = $options;
	 }

	 public function undo()
	 {

	 }
}