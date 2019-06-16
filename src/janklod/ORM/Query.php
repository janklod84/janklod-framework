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
* @var  array           $arguments    [ Arguments ]
* @var  array           $queries      [ Total executed SQL queries ]
* @var  bool            $executed     [ Excecution status ]
* @var  bool            $setup    [ Connection status ]
* @var  QueryBuilder    $builder      [ Query builder ]
* @var  object          $model        [ Model class object ]
* @var  string          $sql          [ SQL request ]
* @var  string          $table        [ Name of table ]
* @var  string          $fetchHandler [ FetchMode handler ]
*/
protected static $instance;
protected static $connection;
protected static $statement;
protected static $result;
protected static $count;
protected static $lastId;
protected static $arguments = [];
protected static $queries   = [];
protected static $executed  = false;
protected static $setup = false;
protected static $builder;
protected static $model;
protected static $sql;
protected static $table;
protected static $fetchHandler = 'FetchObject';


/**
* Constructor
* 
* @param  \PDO     $connection
* @param   string  $table
* @return  self
*/
public static function setup(PDO $connection, $table='')
{
    self::$connection = $connection;
    self::$builder    = new QueryBuilder(); // Query Builder
    self::$table      = $table;
    self::$setup      = true;
    return new static;
}


/**
 * Add table
 * 
 * @param string $table 
 * @param object $model
 * @return self
*/
public static function table($table='', object $model = null)
{
    self::$model = $model;
    if(self::$table !== '')
    {
        return new static; 
    }else{
       self::$table = $table;
       return new static; 
    }

    
}


/**
 * Get model object
 * 
 * @param string $classname 
 * @return object
 */
public static function getModel($classname)
{
    if(!class_exists($classname))
    {
         throw new Exception(
          sprintf('Sorry class <strong>%s</strong> does not exist!', $classname)
        );
         
    }
    return new $classname();
}


/**
 * Get Table
 * 
 * @return string
 * @throws \Exception
*/
public static function getTable()
{
    if(self::$table === '')
    {
       throw new Exception('Sorry, no table yet setted!');        
    }
    return self::$table;
}



/**
* Fetch class
* 
* @param string $entity [class name]
* @param array $arguments ['mode' => 'PDO::FETCH_CLASS|PDO::FETCH_OBJ..']
* @return 
*/
public static function fetchClass($entity=null, $arguments = [])
{
   self::fetchModeRegister('FetchClass', [
     'entity' => $entity,
     'arguments' => $arguments
   ]);
   return new static;
}



/**
* Fetch column
* @param int $colno [number of column]
* @param array $arguments ['mode' => 'PDO::FETCH_COLUMN|PDO::FETCH_OBJ..']
* @return 
*/
public static function fetchColumn($colno=null, $arguments = [])
{
    self::fetchModeRegister('FetchColumn', [  
      'column' => $colno, 
      'arguments' => $arguments
    ]);
    return new static;
}


/**
* Fetch into
* 
* @param object $object
* @param array $arguments ['mode' => 'PDO::FETCH_INTO|PDO::FETCH_OBJ..']
* @return 
*/
public static function fetchInto($object=null, $arguments = [])
{
    self::fetchModeRegister('FetchInto', [  
      'object' => $object,   
      'arguments' => $arguments
    ]);
    return new static;
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
      
      // to add begin transaction ...

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
      self::setFetchMode();

      // get results
      self::$result = self::$statement->fetchAll();

      // rows count
      self::$count  = self::$statement->rowCount();

      // last insert id
      self::$lastId = self::$connection->lastInsertId();
           
      // to add commit ...

   }catch(PDOException $e){
      
      // to add rollback ...

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
 * Query::exec('CREATE DATABASE `test`');
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
 * $result = Query::table()->where('id', 3); [ if table is setted yet!]
 * debug($result);
 * 
 * @param  string $id
 * @param  mixed $value
 * @param  string $operator
 * @return array
*/
public function where($field='', $value=null, $operator='=')
{
     self::ensureSetup();
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
 * $result = Query::table()->findAll();
 * 
 * $selects = ['username', 'password'];
 * $result = Query::table()->findAll($selects);
 * 
 * $result = Query::table()->findAll('username', 'role');
 * debug($result);
 * 
 * @param string|array ...$selects
 * @return array
*/
public function findAll(...$selects)
{
     self::ensureSetup();
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
  self::ensureSetup();
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
 * 
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
 * Describe Table
 * 
 * @param string $table 
 * @return array
 */
public function describe()
{
    self::ensureSetup();
    $sql = self::$builder->describe(self::$table);
    return self::execute($sql)->results();
}

/**
 * Fetch columns table
 * 
 * Ex: Query::table('users')->columns()
 * or  Query::table()->columns() [ If table yet setted ! ]
 * 
 * @param string $table 
 * @return array
*/
public function columns()
{
   self::ensureSetup();
   $sql = self::$builder->showColumn(self::$table);
   return self::execute($sql)->results();
}


/**
 * Set Fields 
 * Add values properties
 * 
 * @param object $classObj
 * @param string $table
 * @return array
*/
public function setProperties(object $classObj = null, string $table='')
{
     self::ensureSetup();
     $table = $table ?: self::$table;
     $columns = $this->columns($table);
     $fields = [];
     foreach($columns as $column)
     {
         $key = $column->Field;
         if(!property_exists($classObj, $key))
         {
             exit(sprintf(
              'Sorry property <b>%s</b> does not exist in class <b>%s</b>',  
              $key, 
              $classObj
            ));
         }
         // FIX here if property has not data or not isset
         $fields[$key] = $classObj->{$key};
     }
     return $fields;
}


/**
 * Determine if has property in data
 * 
 * @param string $key 
 * @param array $properties 
 * @return bool
*/
public function hasAttribute($key='', $properties = []): bool
{
   return in_array($key, $properties);
}



/**
 * Storage data in to database
 * 
 * @param object $model
 * @return int [ Last Insert id ]
*/
public function store(object $object)
{
    self::ensureSetup();
    if(self::$table)
    {
       if(property_exists($object, 'id'))
       {
            $data = $this->setProperties($object);
            if($this->isNewRecord($object))
            {
                // Update record
                $this->update($data, $object->id);
            }else{
                // Create new record
                $this->create($data);
            }
            return $this->lastId();
       }else{
          throw new \Exception(
          'You have not property named [id] try to set it please'
          );
       }
    }else{
       throw new \Exception(
       'Data can not be stored because detected [ Empty Table ]'
       );
    }
}



/**
 * Determine if record is new or not
 * @param object $object
 * @return bool
*/
public function isNewRecord(object $object)
{ 
   return isset($object->id);
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
    self::ensureSetup();
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
     self::ensureSetup();
    return self::$statement->closeCursor();
}


/**
 * Get all executed queries
 * 
 * @return array
*/
public static function queries()
{
    return self::$queries;
} 


/**
 * Get htmt executed queries
 * This template use bootstrap 3-4
 * 
 * Ex: Query::output();
 * 
 * @return void
*/
public static function output()
{

 self::ensureSetup();
 $i = 1;
 $template  = '<table class="table">';
 $template .= '<thead>';
 $template .= '<tr>';
 $template .= '<th scope="col">#</th>';
 $template .= '<th scope="col">Executed Queries :</th>';
 $template .= '</tr>';
 $template .= '<tbody>';
 $template .= '<tr>';
 if(!empty(self::$queries)):
 foreach(self::$queries as $query):
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
 echo $template;
}


/**
* Set Fetch mode
* 
* @return void
*/
private static function setFetchMode()
{
    $class = sprintf(
      '\\JK\\ORM\\Fetch\\%s', 
      ucfirst(self::$fetchHandler)
    );
    if(!class_exists($class))
    {
        exit(sprintf('class <strong>%s</strong> does not exist!', $class));   
    } 
    $obj = new $class(self::$statement, self::$arguments);
    call_user_func([$obj, 'setMode']);
}


/**
* Register fetch params
* 
* @param string $fetchHandler [ name of class ]
* @param array $arguments
* @return void
*/
private static function fetchModeRegister(
$fetchHandler = null, 
$arguments = []
)
{
     self::$fetchHandler = $fetchHandler; 
     self::$arguments    = $arguments;
}


/**
 * Add Query
 * 
 * @param string $sql
 * @return void
*/
private static function addQuery($query)
{
    if($query instanceof QueryBuilder)
    {
        array_push(self::$queries, $query->sql());
    }elseif(is_string($query)){
       array_push(self::$queries, $query);
    }
}



/**
 * Make sure has setting up [setup]
 * 
 * @return void
*/
private static function ensureSetup()
{
    if(self::$setup === false)
     {
         throw new Exception('No connection checked to Query [ ORM ]');
     }
}

}