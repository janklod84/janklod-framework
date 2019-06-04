<?php 
namespace JK\Database\Migrations;


use JK\Database\Migrations\Queries\TableQuery;
use JK\Database\Database;

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
          $sql = TableQuery::create($blueprint, $table);
          Database::execute($sql);
    }
    
    
    /**
     * Drop a table if exists.
     * @param  string  $table  The table name to drop.
     * @return void
    */
    public static function drop(string $table)
    {
        $sql = TableQuery::dropIfExists($table);
        Database::execute($sql);
    }

}