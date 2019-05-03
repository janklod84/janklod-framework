<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Config;


/**
 * @package JK\Database\Connection 
*/ 
class Connection
{
	  
	  /**
	   * Make connection to \PDO
	   * @return \PDO
	  */
      public static function make()
      {
	         try 
	         {
	              return new PDO(Config::get('database.dsn'), 
	                             Config::get('database.user'), 
	                             Config::get('database.password'), 
	                             Config::get('database.options')
	                           );
	         
	         }catch(PDOException $e){

	         	 // die('Error connection');
	         	 throw new \Exception($e->getMessage());
	         	 
	         }
      } 
}