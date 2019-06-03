<?php 
namespace JK\Database\Migrations;


/**
 * @package JK\Database\Migrations\BluePrint 
*/ 
class BluePrint 
{

/**
* @var string $table    [ The table name. ]
* @var string $primary  [ The table primary key. ]
* @var array  $columns  [ Table columns. ]
*/
public $table   = '';
public $primary = '';
public $columns = [];


/**
 * Constructor
 * @param  string  $table [ Table name ]
 * @return void
*/
public function __construct(string $table)
{
     $this->table = $table;
}


/**
* Create a new auto increment integer.
* @param  string  $name  [ Column name. ]
* @return Column
*/
public function increments($name): Column
{
    $column = new Column([
        'name'          => $name,
        'type'          => 'int',
        'length'        => 11,
        'autoincrement' => true
    ]);
    array_push($this->columns, $column);
    $this->primary = $name;
    return $column;
}


/**
* Create a new integer column.
* @param  string  $name    [ Column name.   ]
* @param  int     $length  [ Column length. ]
* @return Column
*/
public function integer($name, $length = 11): Column
{
    $column = new Column([
        'name'      => $name,
        'type'      => 'int',
        'length'    => $length
    ]);
    array_push($this->columns, $column);
    return $column;
}


/**
* Creates a new varchar column.
* @param  string  $name    [ Column name.   ]
* @param  int     $length  [ Column length. ]
* @return Column
*/
public function string($name, $length = 200): Column
{
    $column = new Column([
        'name'      => $name,
        'type'      => 'varchar',
        'length'    => $length
    ]);
    array_push($this->columns, $column);
    return $column;
}

/**
* Creates a boolean column.
* @param  string  $name  The column name.
* @return Column
*/
public function boolean($name): Column
{
    $column = new Column([
        'name'      => $name,
        'type'      => 'tinyint',
        'default'   => '0',
        'length'    => 1
    ]);
    array_push($this->columns, $column);
    return $column;
}


/**
* Creates a text column.
* @param  string  $name  [ The column name. ]
* @return Column
*/
public function text($name): Column
{
    return $this->add($name, 'text');
}


/**
* Creates a datetime column.
* @param  string  $name  The column name.
* @return Column
*/
public function datetime($name): Column
{
   return $this->add($name, 'datetime');
}


/**
* Create the created_at 
* and updated_at timestamps.
* @return void
*/
public function timestamps()
{
    $this->datetime('created_at');
    $this->datetime('updated_at');
}


/**
 * Get all columns
 * @return array
*/
public function columns()
{
    return $this->columns;
}


/**
* Adds a column.
* @param  string  $name  [ The column name. ]
* @param  string  $type  [ The column type. ]
* @return Column
*/
private function add($name, $type): Column
{
    $column = new Column([
        'name' => $name,
        'type' => $type
    ]);
    array_push($this->columns, $column);
    return $column;
}

}