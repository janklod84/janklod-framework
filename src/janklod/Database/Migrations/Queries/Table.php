<?php 
namespace JK\Database\Migrations\Queries;

use JK\Database\Builders\BluePrint;


/**
 * Class Table
 * @package JK\Database\Migrations\Queries\Table
*/ 
class Table
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
         $i      = 0;

         foreach ($blueprint->columns as $column) 
         {
            // Add column name and type.
            $sql .= sprintf('`%s` %s', $column->name, $column->type);

            // Do we have a length?
            if($column->length !== 0)
            {
                $sql .= '(' . $column->length . ')';
            }

            // Set nullable/default.
            if($column->nullable === true && $column->default === '') 
            {
                $sql .= ' DEFAULT NULL';

            }else if ($column->default !== ''){

                $sql .= sprintf(' DEFAULT "%s"', $column->default);

            }else{

                $sql .= ' NOT NULL';
            }

            // Set auto increment?
            if($column->autoincrement === true)
            {
                $sql .= ' AUTO_INCREMENT';
            }

            // Increment.
            ++$i;

            // If we're no at the end add the comma for the next line.
            if ($i < $total)
            {
                $sql .= ', ';
            }

        } // End Loop [Foreach]

        // Do we have a primary key.
        if ($blueprint->primary !== '') 
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