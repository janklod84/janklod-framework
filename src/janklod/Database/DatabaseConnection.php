<?php 
namespace JK\Database;


use \PDO;
use \PDOException;
use \Exception;


/**
 * @package JK\Database\DatabaseConnection 
*/ 
class DatabaseConnection
{
	  
	  const DEFAULT_OPTIONS = [
         PDO::ATTR_PERSISTENT => false,
         PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
	  ];


	  /**
	   * Make connection to \PDO
	   * @return \PDO
	  */
      public static function make()
      {
      	     $dsn     = DatabaseConfig::get('dsn');
      	     $user    = DatabaseConfig::get('user');
      	     $pass    = DatabaseConfig::get('pass');
      	     $options = array_merge(
      	     	         self::DEFAULT_OPTIONS, 
      	     	         DatabaseConfig::get('options')
      	     	        );

	         try 
	         {
	              return new PDO($dsn, $user, $pass, $options);
	         
	         }catch(PDOException $e){

	         	 throw new Exception($e->getMessage());
	         }
      } 
}