<?php 

class Database 
{

private $pdo;
private $debug = false;


public function __construct(
$username, 
$password, 
$database, 
$host = "localhost", 
$port = "3306"){}


public function setDebug($debug){ }

public function queryFirst($query, $params = []) {}



public function query($query, $params = [])
{

   try 
   {
   	    $sql = $this->pdo->prepare($query);
   	    $sql->execute($params);

   	    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
   	    $sql->closeCursor();

   } catch (Exception $e) {

   	    if($this->debug)
   	    {
   	    	 die($e->getMessage() . "<br/>" . $query);

   	    } else {

   	    	die('Impossible de se connecter a la base de donnee');
   	    }
   }

    return new Collection($results);
}


public function close()
{
  
}
}