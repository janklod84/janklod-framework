<?php 
namespace JK\Database\Drivers;


use \PDO;
use \PDOException;
use \Exception;


/**
 * @package JK\Database\Drivers\Driver
*/ 
abstract class Driver
{
     /**
      * For SQLSTATE[HY000]: General error
      * // It's very important [0 for exec(), 1 for execute()]
    */
     private static $options = [
         PDO::ATTR_PERSISTENT => false,
         PDO::ATTR_EMULATE_PREPARES => 0, 
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ];


     protected $driver;
     protected $params = [];

     
     /**
      * 
      * @param string $driver 
      * @param array $params
      * @return 
      */
     public function __construct($driver, $params=[])
     {
          $this->driver = $driver;
          $this->params = $params;
     }


    /**
     * Make connection to \PDO
    */
    abstract public function connect();



    /**
     * Make connection to \PDO
     * @param string $dsn 
     * @param string $user 
     * @param string $password 
     * @param array $options 
     * @return \PDO
     * @throws \Exception
    */
    protected static function make($dsn='', $user='', $password='', $options = [])
    {
           if(!empty($options))
           {
               self::$options = array_merge(self::$options, $options);
           }
           
           try 
           {
                return new PDO($dsn, $user, $password, self::$options);
         
           }catch(PDOException $e){

                throw new Exception($e->getMessage(), 404);
           }

    }
    
     
}