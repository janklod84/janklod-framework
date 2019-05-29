<?php 

if(!function_exists('database')) 
{ 
     
	/**
	 * Get the database instance
	 * @return \PDO
	*/
	function db()
	{
	   return \JK\Database\DB::instance();
	}
}
