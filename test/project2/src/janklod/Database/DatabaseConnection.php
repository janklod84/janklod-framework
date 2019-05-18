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
     * @param string $dsn 
     * @param string $user 
     * @param string $password 
     * @param array $options 
     * @return \PDO
     * @throws \Exception
     */
    public static function make($dsn, $user, $password, $options = [])
    {
           $options = array_merge(self::DEFAULT_OPTIONS, $options);

           try 
           {
                return new PDO($dsn, $user, $password, $options);
         
           }catch(PDOException $e){

                throw new Exception($e->getMessage(), 404);
           }


    }

     
}