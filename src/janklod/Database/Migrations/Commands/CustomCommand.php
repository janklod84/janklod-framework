<?php 
namespace JK\Database\Migrations\Commands;


use JK\Console\CommandInterface;
use JK\Database\DatabaseManager;

/**
 * @package JK\Database\Migrations\Commands\CustomCommand
*/ 
abstract class CustomCommand implements  CommandInterface 
{

	/**
	 * @var \PDO
	*/
	protected $db;


	/**
	 * Constructor
	 * @param \PDO $db connection
	 * @return void
	*/
	public function __construct($db)
	{
	     $this->db = $db;
	}


	/**
	* Execute command
	* @return mixed
	*/
	abstract public function execute();

	/**
	* Roolback command
	* @return void
	*/
	abstract public function undo();

}