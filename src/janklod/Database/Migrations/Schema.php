<?php 
namespace JK\Database\Migrations;


/**
 * Class Schema
 * @package JK\Database\Migrations\Schema 
*/ 
class Schema 
{

    /**
     * Create a new database schema.
     *
     * @param  string    $table     [ The table name. ]
     * @param  \Closure  $callback  [ The schema blueprint.]
     * @return void
    */
    public static function create(string $table, \Closure $callback)
    {
          $blueprint = new BluePrint($table);
          call_user_func($callback, $blueprint);
    }
    
    
    /**
     * Drop a table.
     *
     * @param  string  $table  The table name to drop.
     * @return void
    */
    public static function drop(string $table)
    {
      
    }


    /**
     * Drop a table if not exist.
     *
     * @param  string  $table  The table name to drop.
     * @return void
    */
    public static function dropIfExists(string $table)
    {
         
    }


    // .....


}