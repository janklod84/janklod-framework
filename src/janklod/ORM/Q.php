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

const CONFIG_PARAMS = [
 'dsn', 'driver', 'host', 'port', 
 'charset', 'database', 'user', 
 'prefix_tbl', 'password', 'collation', 'engine'
];

// CONNECTION
/**
* Constructor
* @param \PDO $connection
* @param string $table 
* @return void
*/
public static function setup(\PDO $connection = null, $table='')
{
  self::mapConnection($connection);
  self::$connection = $connection;
  self::$query   = new Query($connection);
  self::$builder = new QueryBuilder($table);
  self::$register['table'] = $table;
  self::$setup = true;
  echo '<div><small>Connected to Q [ORM]</small></div>';
  return new static;
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
 * 
 *  Ex: $config = [
 * 'dsn'        => 'sqlite:database.db',
 * 'driver'     => 'mysql', // sqlite
 * 'host'       => 'localhost',
 * 'port'       => 3306,
 * 'charset'    => 'utf8',
 * 'database'   => 'test', // database.db
 * 'user'       => 'root',
 * 'prefix_tbl' => '',
 * 'password'   => 'Qwerty',
 * 'collation'  => 'utf8mb4',
 * 'engine'     => 'innoDB'
 * ];
 * 
 * Q::connect($config);
 * 
 * @param array $config
 * @param string $table
 * @return void
 * @throws \Exception 
*/
public static function connect(array $config = [], string $table='')
{
    self::ensureConfigParams($config);
    extract($config);
    if(empty($options)){ $options = []; }

    try
    {
        if(is_null(self::$connection))
        {
             self::$connection = new PDO($dsn, $user, $password, $options);
        }
        self::setup(self::$connection, $table);     
        
    }catch(\PDOException $e){

        throw new \Exception($e->getMessage(), 404);
        
    }
}



/**
 * Map registred item
 * @param null $item 
 * @return mixed
*/
public static function mapRegistredItem($item=null)
{
   if(!array_key_exists($item, self::$register))
   {
       exit(sprintf('No <b>%s</b> added for mapping !', $item));
   }
   return self::$register[$item];
}



// SQL 
/**
 * Assign table
 * @return void
*/
private static function assignTable($table='')
{
   self::$table = $table;
   return new self;
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
 * Q::getTable()->all();
 * Q::getTable()->first();
 * @return mixed
*/
public static function getTable($return=false)
{
    if($return === true)
    {
        return self::mapRegistredItem('table');
    }else{
      if(!self::isRegistred('table')) // if empty
      {
          exit('NO TABLE SETTED!');
      }
      return self::assignTable(self::mapRegistredItem('table'));
    }
}



/**
 * Close connection
 * @return void
*/
public static function query()
{
  self::ensureSetup();
  return self::$query;
}



/**
 * Query builder create sql query
 * @param string $table
 * @return \JK\ORM\Queries\QueryBuilder
*/
public static function sql($table='')
{
   self::ensureSetup();
   self::$table  = $table;
   return self::$builder;
}


/**
 * Get values from Query SQL
 * @return \JK\ORM\Queries\QueryBuilder
*/
public static function values()
{
   self::ensureSetup();
   return self::$builder->values;
}


/**
 * Add Table
 * Ex: Q::table('users')->where(3, 'id', '=');
 * @param string $table 
 * @return self
*/
public static function table($table='')
{
    self::ensureSetup();
    return self::assignTable($table);
}



// RECORDS

/**
 * Where Query
 * Ex: Q::table('users')->where(3, 'id', '=');
 * SELECT * FROM users WHERE id = ?
 * @param mixed $value 
 * @param string $field 
 * @param string $operator 
 * @return type
*/
public function where($value, $field='id', $operator='=')
{
      self::ensureSetup();
      $selectSql = self::$builder->select()
                                 ->from(self::$table)
                                 ->where($field, $value, $operator)
                                 ->limit(1);
      $values = self::$builder->values;
      self::$query->execute($selectSql, $values);
      return new static;
}


// RECORD RESULTS

/**
 * Get results
 * Ex: Q::table('users')->where(3, 'id', '=')
 *                        ->results()
 * @return array
*/
public function results()
{
     self::ensureSetup();
     return self::$query->results();
}


/**
 * Get first result
 * Ex: Q::table('users')->where(3, 'id', '=')
 *                      ->first()
 * @return array
*/
public function first()
{
     self::ensureSetup();
     return self::$query->first();
}



/**
 * Select all records
 * @return array
*/
public function all()
{
    self::ensureSetup();
    $selectSql = self::$builder->select()
                               ->from(self::$table);
    return self::$query->execute($selectSql)
                       ->results();
}


/**
 * Create new record
 * @param array $params 
 * @return 
*/
public function create($params=[])
{
  self::ensureSetup();
  if(!empty($params))
  {
      $sql = self::$builder
                  ->insert(self::$table)
                  ->set($params);
      return self::$query->execute($sql, self::$builder->values);
  }
}


/**
 * Read|Find data
 * @param mixed $value 
 * @param string $field 
 * @return 
*/
public function read($value=null, $field='id')
{     
   self::ensureSetup();
   if($value)
   {
       $sql = self::$builder
               ->select()
               ->from(self::$table)
               ->where($field, $value)
               ->limit(1);
        return self::$query->execute($sql, self::$builder->values)
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
public function update($params=[], $value=null, $field='id')
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
 * Delete one record
 * @param array $params
 * @param mixed $value 
 * @param string $field
 * @return 
*/
public function delete($value=null, $field='id')
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


/**
 * Get Last ID
 * @return int
*/
public static function lastId()
{
    self::ensureSetup();
    return self::$query->lastID();
}


/**
 * Get Row count
 * @return int
*/
public static function count()
{
    self::ensureSetup();
    return self::$query->count();
}



/**
 * Make transaction
 * @param \Closure $callback
 * @return mixed
*/
public static function transaction(\Closure $callback)
{
    self::ensureSetup();
    try
    {
        self::$query->transaction();
        call_user_func($callback, self::$table);
        self::$query->commit();

    }catch(\PDOException $e){
         self::$query->rollback();
         throw new \Exception($e->getMessage());
    }

}


// 
private function isNewRecord()
{
  
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
public static function exec($sql)
{		 
	  self::ensureSetup();
	  return self::$query->exec($sql);
}


/**
 * All executed Queries
 * @return array
*/
public static function queries()
{
   self::ensureSetup();
   return self::$query->executed();
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
         $queries = self::queries();
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
 * Show message if connection already setted
 * And Map connection 
 * @param \PDO $connection
 * @return void
*/
private static function mapConnection($connection)
{
    if(self::$setup === true)
    {
        exit('Q [ORM] already connected!');
    }
    
    if(is_null($connection))
    {
       exit('You must to set up connection for [Q ORM]!');
    }

}

/**
 * Capture config
 * @param array $config 
 * @return void
*/
private static function ensureConfigParams($config=[])
{
    // to replace by array_filter !
    if(!empty($config))
    {
        foreach(array_keys($config) as $key)
        {
             if(!in_array($key, self::CONFIG_PARAMS))
             {
                  exit(
                    sprintf(
                    'Sorry This key <b>%s</b> does not in required config params',  
                    $key
                    )
                  );
             }
        }
    }
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