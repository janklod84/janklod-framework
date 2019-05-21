<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;


/**
 * @package JK\ORM\Query 
*/ 
class Query 
{
	   
/**
* @var array $queries
*/
private $queries = [];


/**
 * Constructor
 * @param array $queries 
 * @return void
 */
public function __construct($queries = [])
{
     $this->queries = $queries;
}


/**
 * Print html
 * @return string
*/
public function printOut()
{
   if($count = count($this->queries))
   {
       $i = 1;
       $html = '<strong>Count executed queries : </strong>'. $count;
       $html .= '<br/>';
       $html .= '<strong>Currents queries : </strong>';
       foreach($this->queries as $query)
       {
           $html .= '<div>'. $i.'--- '. $query . '</div>';
           $i++;
       }
       // $html .= implode('<br/>', $this->queries);
   }
   echo $html;
}

}