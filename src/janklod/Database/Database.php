<?php 
namespace JK\Database;


/**
 * @package JK\Database\Database
*/ 
class Database
{
	   
        
     /**
      * @var \PDO $instance 
     */
     private static $instance;


     /**
       * prevent instance from being cloned
       * @return void
     */
     private function __clone(){}



	  /**
	    * prevent instance from being unserialized
	    * @return void
	  */
	  private function __wakeup(){}


	  /**
	   * Constructor
	   * @return void
	  */
	  public function __construct() 
	  {

	  }

        
	  /**
	   * Get Database Connection PDO Object
	   * @return \PDO
	  */
	  public static function connect()
	  {
	     if(is_null(self::$instance))
	     {
	     	 self::$instance = Connection::make();
	     }
	     return self::$instance;
	  }

	    
	 /**
	   * Exceute query
	   * @param string $sql 
	   * @param array $params 
	  * @return \PDOStatement
	 */
	 public function query($sql, $params = [])
	 {
         return self::connect()->query($sql);
	 }


	 /**
      * Return query last insert id 
      * @return int
     */
    public function lastId(): int
    {
        return (int) self::connect()->lastInsertId();
    }   


    /**
     * Begin transaction
     * @param string $sql 
     * @return bool
    */
    public function transaction()
    {
         return self::connect()->beginTransaction();
    }
    

    /**
     * Roolback
     * @return bool
    */
    public function rollBack()
    {
         return self::connect()->rollBack();
    }

    
    /**
     * Commit
     * @return bool
    */
    public function commit()
    {
         return self::connect()->commit();
    }


    /**
     * Close current connection
     * @return void
    */
    public function close()
    {
    	 if(self::connect())
    	 {
    	 	 self::$instance = null;
    	 }
    }

}