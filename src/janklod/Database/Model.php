<?php 
namespace JK\Database;

use JK\Database\Exceptions\NotFoundException;
use \Exception;
use \Query;
use \DB;
use \PDO;
use JK\ORM\QueryBuilder;



/**
 * @package JK\Database\Model 
*/ 
abstract class Model 
{

/**
 * @var  \PDO          $pdo
 * @var  string        $table
 * @var  string        $class
 * @var  QueryBuilder  $queryBuilder
*/
protected $pdo;
protected $table=null;
protected $class=null;
protected $queryBuilder;



/**
 * Construtor
 * 
 * @return void
*/
public function __construct()
{
     if($this->table === null)
	 {
	 	 throw new Exception(
	 	 "Class ". get_class($this) ." has not property table!"
	 	 );
	 }
	 if($this->class === null)
	 {
	 	 throw new Exception(
	 	 	"Class ". get_class($this) ." has not property class!"
	 	 );
	 }

	 Query::fetchClass($this->class);
	 Query::addTable($this->table);
	 $this->queryBuilder = new QueryBuilder();
	 $this->pdo = Query::connect();
}

/**
 * Find one post
 * 
 * @param int $id 
 * @return mixed
*/
public function find(int $id)
{
    $query = $this->pdo->prepare('SELECT * FROM '. $this->table .' WHERE id = :id');
	$query->execute(['id' => $id]);
	$query->setFetchMode(PDO::FETCH_CLASS, $this->class);
	$result = $query->fetch();
	if($result === false)
	{
        throw new NotFoundException($this->table, $id);
	}
	return $result;
}


// /**
//  * Find All
//  * 
//  * @return array
// */
// public function findAll()
// {
// 	return Query::table()->findAll();
// }


}