<?php 
namespace JK\Database\Migrations;


use JK\Database\Migrations\Queries\Table;
use JK\Database\DatabaseManager;

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
          $sql = Table::create($blueprint, $table);
          DatabaseManager::execute($sql);
    }
    
    
    /**
     * Drop a table if exists.
     * @param  string  $table  The table name to drop.
     * @return void
    */
    public static function drop(string $table)
    {
        $sql = Table::dropIfExists($table);
        DatabaseManager::execute($sql);
    }

}