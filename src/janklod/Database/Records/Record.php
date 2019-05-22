<?php 
namespace JK\Database\Records;


/**
 * @package JK\Database\Records\Record
*/ 
class Record extends Model
{
   
/**
 * @var string $table
 * @var array $params
*/
protected $table;
protected $params = [];


/**
 * Constructor
 * @param string $table
 * @param array $params
 * @return void
*/
public function __construct(
$table = null, 
$params = []
)
{
	parent::__construct();
    $this->table = $table;
    $this->params = $params;
}



/**
 * Execute Query
 * @param string $sql 
 * @param array $params 
 * @param bool $fetch 
 * @return Query
*/
protected function execute(
$sql='', 
$params = [], 
$fetch = true)
{
     return $this->statement
                 ->execute($sql, $params, $fetch);
}



/**
 * Get values
 * @return array
*/
public function values()
{
    return $this->builder->values;
}

}