<?php 
namespace JK\Database\Migrations\Queries;

use JK\Database\Builders\BluePrint;


/**
 * Class Table
 * @package JK\Database\Migrations\Queries\TableQuery
*/ 
class TableQuery
{

    /**
     * Build a new sql request for creating table
     * @param BluePrint $blueprint
     * @param string $table [  Table name  ]
     * @return string
    */
    public static function create($blueprint, string $table)
    {
         // Build the create table syntax.
         $sql = sprintf('CREATE TABLE IF NOT EXISTS `%s` (', $table);

         // Loop through each column to add it.
         $total  = count($blueprint->columns);
         $i = 0;

         foreach ($blueprint->columns as $column) 
         {
            $sql .= sprintf('`%s` %s', $column->name, $column->type);
            if($column->length !== 0)
            {
                $sql .= '(' . $column->length . ')';
            }
            if($column->nullable === true && $column->default === '') 
            {
                $sql .= ' DEFAULT NULL';

            }else if ($column->default !== ''){

                $sql .= sprintf(' DEFAULT "%s"', $column->default);

            }else{

                $sql .= ' NOT NULL';
            }

            if($column->autoincrement === true)
            {
                $sql .= ' AUTO_INCREMENT';
            }

            // Increment.
            ++$i;

            if ($i < $total)
            {
                $sql .= ', ';
            }

        } // End Loop [Foreach]

        if($blueprint->primary !== '') 
        {
            $sql .= sprintf(', PRIMARY KEY(`%s`)', $blueprint->primary);
        }

        // Close syntax.
        $sql .= ')';

        return $sql;
    }


    /**
     * Drop Table if exists
     * @param string $table 
     * @return string
    */
    public static function dropIfExists(string $table)
    {
        return sprintf('DROP TABLE IF EXISTS `%s`', $table);
    }
    

}