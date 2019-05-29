<?php 
namespace JK\ORM;


use \PDO;
use JK\ORM\Queries\QueryBuilder;
use JK\ORM\Statement\Query;


/**
 * @package JK\ORM\Q
*/ 
class Q
{
     
/**
* @var $instance;
* @var \PDO $connection
* @var string $table;
* @var \JK\ORM\Quseries\QueryBuilder $builder
* @var array $register
* @var \JK\ORM\Statement\Query $query
* @var bool $setup;
*/
private static $connection;
private static $table = '';
private static $builder;
private static $register = [];
private static $query;
private static $setup = false;


/**
* Constructor
* @param \PDO $connection
* @param string $table 
* @return void
*/
public static function setup(\PDO $connection = null, $table='')
{
  if(is_null($connection))
  {
     exit('You can to set up connection!');
  }
  self::addConnection($connection);
  self::$query   = new Query($connection);
  self::$builder = new QueryBuilder();
  self::$register['table'] = $table;
  self::$setup = true;
  return new static;
}


/**
 * Add connection
 * @param \PDO $connection 
 * @return void
*/
public static function addConnection(\PDO $connection)
{
  self::$connection = $connection;
}


/**
 * Query statement
 * @return \JK\ORM\Statement\Query
*/
public static function query()
{
  self::ensureSetup();
  return self::$query;
}


/**
 * Query builder create sql query
 * @return \JK\ORM\Queries\QueryBuilder
*/
public static function sql()
{
  self::ensureSetup();
  return self::$builder;
}


/**
 * Close connection
 * @return void
*/
public static function close()
{
  self::ensureSetup();
  self::$connection = null;
}


/**
 * Add connection if has not connection
 * @param string $dsn 
 * @param string $user 
 * @param string $password 
 * @param array $options 
 * @return \PDO
*/
public static function connect(
$dsn='', 
$user='', 
$password='', 
$options=[]
): \PDO
{

    try
    {
        if(is_null(self::$connection))
        {
             self::$connection = new PDO($dsn, $user, $password, $options);
        }
        self::setup(self::$connection);     

    }catch(\PDOException $e){

        throw new \Exception($e->getMessage(), 404);
        
    }
}





/**
 * Fetch class
 * @param  $entity [name class : app\\models\\MyModel]
 * @param  array $arguments 
 * @return Query
*/
public static function fetchClass($entity, $arguments=[])
{
  self::ensureSetup();
  self::$query->fetchClass($entity, $arguments);
}


/**
* Fetch column
* @param int $colno [number of column]
* @param array $arguments ['mode' => 'PDO::FETCH_COLUMN|PDO::FETCH_OBJ..']
* @return 
*/
public static function fetchColumn($colno=null, $arguments = [])
{
  self::ensureSetup();
  self::$query->fetchColumn($colno, $arguments);
}


/**
* Fetch into
* @param object $object
* @param array $arguments ['mode' => 'PDO::FETCH_INTO|PDO::FETCH_OBJ..']
* @return 
*/
public static function fetchInto($object=null, $arguments = [])
{
  self::ensureSetup();
  self::$query->fetchColumn($object, $arguments);
}


/**
 * Exceute Query
 * @param string $sql 
 * @param array $params 
 * @return mixed
*/
public static function execute($sql, $params=[])
{
  self::ensureSetup();
  return self::$query->execute($sql, $params);
}



/**
 * Execute simple query
 * QQ::exec('DELETE FROM table ')
 * @param string $sql 
 * @return bool
 */
public static function exec($sql='')
{		 
	self::ensureSetup();
	return self::$query->exec($sql);
}


/**
 * Map item
 * @param null $item 
 * @return mixed
*/
public static function map($item=null)
{
   if(!array_key_exists($item, self::$register))
   {
       exit(sprintf('No <b>%s</b> added for mapping !', $item));
   }
   return self::$register[$item];
}


/**
 * Add Table
 * @param string $table 
 * @return void
*/
public static function addTable($table='')
{
    self::$register['table'] = $table;
}



/**
 * Get Table
 * @return mixed
*/
public static function getTable($return=false)
{
    self::ensureSetup();
    if($return === true)
    {
        return self::map('table');
    }else{
      if(!self::isRegistred('table')) // if empty
      {
          exit(sprintf('Sorry no table yet setted!'));
      }
      return self::assignTable(self::map('table'));
    }
}


/**
 * Add Table
 * @param string $table 
 * @return void
*/
public static function table($table='')
{
   self::ensureSetup();
   return self::assignTable($table);
}


/**
 * Assign table
 * @return void
*/
public static function assignTable($table='')
{
   self::$table = $table;
   return new self;
}




/**
 * Make select query without from 
 *
 * Ex: Q::select('column1', 'column2', 'column3'..)->where('id', '4')->.... 
 * Ex: $columns = ['field1', 'field2', ...]; Q::select($columns)->where()...
 *
 *
 * @param mixed ...$selects
 * @return \JK\ORM\Queries\QueryBuilder
*/
public static function select(...$selects)
{
  self::ensureSetup();
  $sql = self::$builder->select($selects);
  if(is_array($selects[0]))
  {
        $sql = self::$builder->select($selects[0]);
  }
  if($table = self::map('table'))
  {
        return $sql->from($table);
  }
  return $sql;
}




/**
 * Create new record
 * @param array $params 
 * @return 
*/
public function create($params=[])
{
  self::ensureSetup();
  if($params)
  {
      $sql = self::$builder
                  ->insert(self::$table)
                  ->set($params);
      return self::execute($sql, self::$builder->values);
  }
}


/**
 * Read data
 * @param string $value 
 * @param string $field 
 * @return 
*/
public function read($value='', $field='id')
{     
   self::ensureSetup();
   if($value)
   {
       $sql = self::$builder
               ->select()
               ->from(self::$table)
               ->where($field, $value)
               ->limit(1);
        return self::execute($sql, self::$builder->values)
               ->first();
   }
}


/**
 * Update record
 * @param array $params
 * @param mixed $value 
 * @param string $field
 * @return 
*/
public function update($params=[], $value, $field='id')
{
  self::ensureSetup();
  if($params && $value)
  {
       $sql = self::$builder
              ->update(self::$table)
              ->set($params)
              ->where($field, $value);
       return self::execute($sql, self::$builder->values);
  }
}


/**
 * store data // update or insert
 * @return 
*/
public function store()
{
  self::ensureSetup();
     // get columns 
    // and determine if has id 
    // or determine if isset property
    // if isset we will be update otherwise we'll create new record
}


// 
private function isNewRecord()
{

}


/**
 * Delete one record
 * @param array $params
 * @param mixed $value 
 * @param string $field
 * @return 
*/
public function delete($value, $field='id')
{
   self::ensureSetup();
   if($value)
   {
        $sql = self::$builder
                ->delete(self::$table)
                ->where($field, $value);
        return self::execute($sql, self::$builder->values);
   }
}



/**
 * Get all records
 * @return array
*/
public function all()
{
  self::ensureSetup();
  $sql = self::$builder 
                ->select()
                ->from(self::$table);
  return self::execute($sql)
                ->results();
}


/**
 * Get html output executed queries
 * @param bool $show
 * @return void
*/
public static function output($show=true)
{
  self::ensureSetup();
  if($show)
  {
      if(!is_null(self::$query))
      {
         $queries = self::$query->executed();
         self::html($queries);
      }else{
          self::html();
      }
  }
}


/**
 * Get htmt executed queries
 * @param array $queries 
 * @return void
*/
public static function html($queries=[])
{
	   self::ensureSetup();
     $i = 1;
     $template = '<table class="table">';
     $template .= '<thead>';
     $template .= '<tr>';
     $template .= '<th scope="col">#</th>';
     $template .= '<th scope="col">Executed Queries :</th>';
     $template .= '</tr>';
     $template .= '<tbody>';
     $template .= '<tr>';
     if(!empty($queries)):
     foreach($queries as $query):
     $template .= '<td>'. $i++ .'</td>';
     $template .= '<td>'. $query .'</td>';
     $template .= '</tr>';
     endforeach;
     else:
     $template .= '<td></td>';
     $template .= '<td col="2">No Query Executed!</td>';
     endif;
     $template .= '</tr>';
     $template .= '</tbody>';
     $template .= '</table>';
     $template .= '<strong>Count executed queries : </strong>'. count($queries);
     echo $template;
}


/**
 * Make sure has setting up [setup]
 * @return void
*/
private static function ensureSetup($message='')
{
	$output = 'Sorry you must to setup [Q (ORM) ]';
	if($message !== '')
	{
		$output .= $message;
	}
	
	if(self::$setup === false)
	{
		exit($output);
	}
}


/**
 * Determine if type has registred
 * @param string $type 
 * @return bool
*/
private static function isRegistred($type=''): bool
{
   return ! empty(self::$register[$type]); // not empty
}


}