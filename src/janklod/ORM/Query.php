<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;
use \Exception;


/**
 * Class Query
 * 
 * @package JK\ORM\Query 
*/ 
class Query 
{

/**
* @var  self            $instance     [ Instance of current class ]
* @var  \PDO            $connection   [ Object PDO ]
* @var  \PDOStatement   $statement    [ PDOStatement ]
* @var  array           $result       [ Result query ]
* @var  int             $count        [ Row affected count ]
* @var  int             $lastId       [ Last insert id ]
* @var  array           $arguments    [ ]
* @var  array           $queries      [ Total executed SQL queries ]
* @var  bool            $error        [ Error status ]
* @var  bool            $executed     [ Excecution status ]
* @var  bool            $connected    [ Connection status ]
* @var  string          $fetchHandler [ FetchMode handler ]
* @var  \JK\ORM\Queries\QB $builder
* @var  string          $sql          [ SQL request ]
* @var  string          $table        [ Name of table ]
*/
protected static $instance;
protected static $connection;
protected static $statement;
protected static $result;
protected static $count;
protected static $lastId;
protected static $arguments = [];
protected static $queries   = [];
protected static $error     = false;
protected static $executed  = false;
protected static $connected = false;
protected static $builder;
protected static $sql;
protected static $table;

// protected static $fetchHandler = 'FetchObject';


// Fetch handler namespace
// const FH_NS = '\\JK\\Statement\\Fetch\\%s';


/**
* Constructor
* 
* @param  \PDO     $connection
* @param   string  $table
* @return  self
*/
public static function setup(PDO $connection, $table='')
{
    if(is_null(self::$instance))
    {
         self::$connection = $connection;
         self::$builder    = new QueryBuilder();
         self::$table      = $table;
         self::$connected  = true;
         self::$instance   = new static;
    }
    return self::$instance;
}

/**
 * Make connection
 * 
 * @param string $driver 
 * @param array $config 
 * @param string $table 
 * @return self
 */
public static function connect($driver='mysql', $config=[], $table='')
{
      $connection = Connection::make($driver, $config);
      return self::setup($connection, $table);
}


/**
 * Set alias of class
 * 
 * @param string $alias 
 * @return void
*/
public function alias($alias='QB')
{
   class_alias(__CLASS__, $alias);
}




/**
 * Add table
 * 
 * @param string $table 
 * @return self
*/
public static function table($table='')
{
    if(self::$table !== '')
    {
        return new static;
    }else{
       if($table === '')
       {
          exit('Empty Table!');
       }
       self::$table = $table;
    }
    return new static;
}

/**
 * Get Table
 * 
 * @return string
*/
public static function getTable()
{
    if(self::$table !== '')
    {
        return self::$table;
    }
}


/**
 * Execute Query
 * 
 * Ex: Query::execute('SELECT * FROM `users` WHERE id = ?', [3]);
 * Ex: Query::execute('SELECT * FROM `users` WHERE id = :id', ['id' => 3]);
 * 
 * @param string $sql 
 * @param array  $params 
 * @return self
 * @throws \Exception
*/
public static function execute($sql, $params=[])
{
   try
   {
      self::ensureSetup();

      // prepare request sql
      self::$statement = self::$connection->prepare($sql);

      // if query executed
      if(self::$statement->execute($params))
      {
          // we add current query in container
          self::addQuery($sql);
          self::$executed = true;
      }

      // set fetch mode
      // self::setFetchMode();

      // get results
      self::$result = self::$statement->fetchAll();

      // rows count
      self::$count  = self::$statement->rowCount();

      // last insert id
      self::$lastId = self::$connection->lastInsertId();
           
      
   }catch(PDOException $e){

      // debug
      self::$executed = false;
      $html  = "<h4>Last Query:</h4>";
      $html .= "<p>%s</p>";
      echo sprintf($html, $sql);
      
      // capture exception
      throw new Exception($e->getMessage(), 404);
   }
   
   return new static;
}



/**
 * Execute simple query
 * 
 * @param string $sql 
 * @return bool
*/
public static function exec($sql='')
{
    self::ensureSetup();
    return self::$connection 
                 ->exec($sql);
}



/**
 * Make transaction
 * 
 * @param \Closure $callback
 * @return mixed
 * @throws \Exception
*/
public static function transaction(\Closure $callback)
{
    try
    {
        self::ensureSetup();
        self::$connection->beginTransaction();
        call_user_func($callback, self::$builder);
        self::$connection->commit();

    }catch(\PDOException $e){

         self::$connection->rollback();
         throw new Exception($e->getMessage());
    }

}



/**
 * Make where query
 * 
 * $result = Query::table('users')->where('id', 3);
 * $result = Query::getTable()->where('id', 3); [ if table is setted yet!]
 * debug($result);
 * 
 * @param  string $id
 * @param  mixed $value
 * @param  string $operator
 * @return array
*/
public function where($field='', $value=null, $operator='=')
{
     $sql = self::$builder->select()
                          ->from(self::$table)
                          ->where($field, $value, $operator)
                          ->limit(1);
     
     return self::execute($sql, self::$builder->values)
                 ->first();
}

/**
 * Find all records
 * 
 * 
 * $result = Query::getTable()->findAll();
 * 
 * $selects = ['username', 'password'];
 * $result = Query::getTable()->findAll($selects);
 * 
 * $result = Query::getTable()->findAll('username', 'role');
 * debug($result);
 * 
 * @param mixed ...$selects
 * @return array
*/
public function findAll(...$selects)
{
     $sql = self::$builder->select($selects)
                          ->from(self::$table);

     return self::execute($sql)
                 ->results();
}



/**
 * Create new record
 * 
 * Ex: Query::table('users')->create([
 *   'field1' => value1,
 *   'field2' => value2,
 *   'field3' => value3
 * ])
 * 
 * @param array $params 
 * @return 
*/
public function create($params=[])
{
  if(!empty($params))
  {
      $sql = self::$builder
                  ->insert(self::$table)
                  ->set($params);
      return self::execute($sql, self::$builder->values);
  }
}


/**
 * Update record
 * 
 * Ex: Query::table('users')->update([
 *   'field1' => value1
 * ], 3)
 * 
 * @param array $params
 * @param mixed $value 
 * @param string $field
 * @return 
*/
public function update($params=[], $value=null, $field='id')
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
 * Return status execution
 * 
 * Exemple:
 * if(Query::done())
 * {
 *    // do something
 * }
 * @return bool
*/
public static function done(): bool
{
   return self::$executed;
}


/**
 * Fetch all records
 * 
 * Ex: Query::execute('SELECT * FROM my_table')->results();
 * 
 * @return mixed
*/
public function results()
{
     return self::$result;
}



/**
 * Get first record
 * 
 * @return array
*/
public function first()
{
    return ! empty(self::$result) ? self::$result[0] : [];
}


/**
* Get row count 
* 
* @return int
*/
public function count()
{
    return self::$count;
}

 
/**
* Get last insert id
* 
* @return int
*/
public function lastId()
{
    return self::$lastId;
}


/**
 * Get info errors
 * @return array
*/
public function errors()
{
    return self::$statement
                ->errorInfo();
}


/**
 * Close cursor
 * close cursor for next query [ somme drivers need it ]
 * @return 
*/
public function close()
{
    return self::$statement->closeCursor();
}


/**
 * Get all executed queries
 * 
 * @return array
*/
public function queries()
{
    return self::$queries;
} 


/**
 * Add Query
 * 
 * @param string $sql
 * @return void
*/
private static function addQuery($sql)
{
     array_push(self::$queries, $sql);
}


/**
 * Make sure has setting up [setup]
 * 
 * @return void
*/
private static function ensureSetup()
{
    if(self::$connected === false)
    {
        exit('Sorry you must to setup [Query (ORM) ]');
    }
}

}