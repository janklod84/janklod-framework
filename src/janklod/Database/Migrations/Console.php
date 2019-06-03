<?php 
namespace JK\Database\Migrations;

use JK\Console\ConsoleInterface;
use JK\Console\IO\Output;
use JK\Console\IO\Input;


/**
 * @package JK\Database\Migrations\Console 
*/ 
class Console implements ConsoleInterface
{

	/**
	 * Help message
	 * @return string
	*/
    public function help(): string
    {
        return 'Handles database migrations.';
    }
    
    
    /**
     * Excecute command
     * @param string $task 
     * @param array $arguments 
     * @return string
    */
    public function execute(string $task = '', array $arguments = []): string
    {
       
    }


    /**
     * Runs the migrations.
     *
     * @param  array  $arguments  Command arguments.
     * @return string
     */
    public function run(array $arguments = []): string
    {
        
    }



    /**
     * Reset migrations.
     *
     * @param  array  $arguments  Command arguments.
     * @return string
     */
    public function reset(array $arguments = []): string
    {
        return '';
    }


    /**
     * Rollback migration.
     *
     * @param  array  $arguments  Command arguments.
     * @return string
     */
    public function rollback(array $arguments = []): string
    {
        return '';
    }


    /**
     * Installs the migrations table.
     *
     * @param  array  $arguments  Command arguments.
     * @return string
     */
    public function install(array $arguments = []): string
    {
      
    }


    /**
     * Creates a new migration.
     *
     * @param  array  $arguments  Command arguments.
     * @return string
     */
    public function create(array $arguments = []): string
    {
        
    }
    /**
     * Generates a blank migration.
     *
     * @param  string  $suffix
     * @param  string  $module
     * @param  string  $migration
     * @return string
     */
    // private function blank($suffix, $module, $migration): string
    // {
        
    // }
}