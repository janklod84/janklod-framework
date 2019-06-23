<?php 
namespace JK\Database\Migrations;


/**
 * Class Migrator
 *
 * @package JK\Database\Migrations\Migrator
*/ 
class Migrator
{
 

/**
 * @var InputInterface  $input
 * @var OutputInterface $output
*/
protected $input;
protected $output;


/**
* Constructor
* 
* @param  InputInterface  $input 
* @param  OutputInterface $output 
* @return void
*/  
public function __construct($input, $output)
{
	 $this->input  = $input;
	 $this->output = $output;
}


public function migrate()
{
	 // migrate all tables
	 # directory /temp/database/migrations/....
	 /**
	 foreach($tables as $table)
	 {
		 // migrate migrate 
	 }
	 */
	 return 'tables successfully migrated';
}

/**
 * Remove all table
 * 
 * @return 
*/
public function rollback()
{
	// cancel action
	# remove all migrations 
	return 'tables removed';
}

/**
 * Create table
 * @return 
*/
public function create()
{
   // create table 
   # migration up 
	return 'table users successfully created';
}

/**
 * Update table
 * @return 
*/
public function update()
{
   // update table 
   # migration up 
	return 'table users successfully updated';
}

/**
 * Delete table
 * @return 
*/
public function delete()
{
	// delete table 
	# migration down
	return 'table users successfully deleted';
}
}