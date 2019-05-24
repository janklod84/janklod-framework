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


/**
* Constructor
* @param \PDO $connection
* @param string $table 
* @return void
*/
public static function setup(\PDO $connection = null, $table='')
{
    if(!$connection)
    {
       exit('You can to set up connection!');
    }
    self::$connection = $connection;
    self::$register['table'] = $table;
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
 * Determine if type has registred
 * @param string $type 
 * @return bool
*/
public static function isRegistred($type=''): bool
{
   return ! empty(self::$register[$type]); // not empty
}

/**
 * Query statement
 * @return \JK\ORM\Statement\Query
*/
public static function query()
{
    return new Query(self::$connection);
}


/**
 * Exceute Query
 * @param string $sql 
 * @param array $params 
 * @return mixed
*/
public static function execute($sql, $params=[])
{
   return self::query()->execute($sql, $params);
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
 * Map type
 * @param null $type 
 * @return void
*/
public static function map($type=null)
{
   if(!array_key_exists($type, self::$register))
   {
       exit(sprintf('Can not map <b>%s</b> !', $type));
   }
   return self::$register[$type];
}


/**
 * Get Table
 * @return string
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
      return self::build(self::map('table'));
    }
}


/**
 * Add Table
 * @param string $table 
 * @return void
*/
public static function table($table='')
{
    return self::build($table);
}


/**
 * Get Builder
 * @return void
*/
public static function build($table='', $sql=false)
{
   self::$table = $table;
   self::$builder = new QueryBuilder();
   if($sql)
   {
      return self::$builder;
   }
   return new self;
}


/**
 * Create new record
 * @param array $params 
 * @return 
*/
public function create($params=[])
{
    $sql = self::$builder
              ->insert(self::$table)
              ->set($params);
    return self::execute($sql, self::$builder->values);
}


/**
 * Read data
 * @param string $value 
 * @param string $field 
 * @return 
*/
public function read($value='', $field='id')
{
     $sql = self::$builder
                 ->select()
                 ->from(self::$table)
                 ->where($field, $value)
                 ->limit(1);
     return self::execute($sql, self::$builder->values)
                 ->first();
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
    $sql = self::$builder
                ->update(self::$table)
                ->set($params)
                ->where($field, $value);
    return self::execute($sql, self::$builder->values);
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
    $sql = self::$builder
                ->delete(self::$table)
                ->where($field, $value);
    return self::execute($sql, self::$builder->values);
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
 * Add connection if has not connection
 * @param string $dsn 
 * @param string $user 
 * @param string $password 
 * @param array $options 
 * @return void
*/
public static function connect($dsn='', $user='', $password='', $options=[])
{
    if(!is_null(self::$connection) && self::$connection instanceof PDO)
    {
         return self::$connection;
    }
    self::$connection = new PDO($dsn, $user, $password, $options);
}


}