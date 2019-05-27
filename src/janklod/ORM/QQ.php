<?php 
namespace JK\ORM;


use \PDO;
use JK\ORM\Queries\QueryBuilder;
use JK\ORM\Statement\Query;


/**
 * @package JK\ORM\QQ
*/ 
class QQ
{
     
/**
* @var $instance;
* @var \PDO $connection
* @var \JK\ORM\Statement\Query $query
* @var \JK\ORM\Quseries\QueryBuilder $builder
*/
private static $connection;
private static $table = '';
private static $builder;
private static $register = [];
private static $query;
private static $sql = ' ';


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
     return self::$query;
}


/**
 * Query builder create sql query
 * @return \JK\ORM\Queries\QueryBuilder
*/
public static function sql()
{
    return self::$builder;
}


/**
 * Close connection
 * @return void
*/
public static function close()
{
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
 * Determine if type has registred
 * @param string $type 
 * @return bool
*/
public static function isRegistred($type=''): bool
{
   return ! empty(self::$register[$type]); // not empty
}




/**
 * Fetch class
 * @param  $entity 
 * @param  array $arguments 
 * @return Query
*/
public static function fetchClass($entity, $arguments=[])
{
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
      return self::$connection 
                 ->exec($sql);
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
 * Make select query
 * @return QueryBuilder
*/
public static function select(...$selects)
{
     $query = self::$builder->select($selects);
     if(is_array($selects[0]))
     {
        $query = self::$builder->select($selects[0]);
     }
     if($table = self::map('table'))
     {
        return $query->from($table);
     }
     return $query;
}




/**
 * Create new record
 * @param array $params 
 * @return 
*/
public function create($params=[])
{
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

}