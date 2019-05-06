<?php 
namespace JK\Database;



/**
 * @package JK\Database\DatabaseManager
*/ 
class DatabaseManager
{
       
     /**
      * @var \PDO $instance 
      * @var  Database $instance
     */
     private static $connection;
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
      private function __construct() 
      {
            self::run();
      }


      /**
       * Determine if has connection
       * @return bool
      */
      public static function isConnected()
      {
           self::$connection instanceof \PDO;
      }

      
      /**
       * Run connection to Database
       * @return void
      */
      public static function open()
      {
           if(!self::isConnected())
           {
                self::$connection = DatabaseConnection::make();
           }
      }


     /**
      * Close current connection
      * @return void
     */
      public static function close()
      {
          self::$connection = null;
      } 


      /**
       * Get Database Connection PDO Object
       * @return \PDO
      */
      public static function connect()
      {
           return self::$connection;
      }


      /**
       * Get instance of database
       * @return self
      */
      public static function instance()
      {
           if(is_null(self::$instance))
           {
               self::$instance = new self();
           }
           return self::$instance;
      }

}