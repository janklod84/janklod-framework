<?php 
namespace JK\ORM;



/**
 * @package JK\ORM\QueryPrinter
*/ 
class QueryPrinter
{
	   
/**
* @var array $queries
*/
private $queries = [];
private $count;



/**
 * Constructor
 * @param array $queries 
 * @return void
 */
public function __construct($queries = [])
{
     $this->queries = $queries;
     $this->count = count($queries);
}


/**
 * Print html
 * @return string
*/
public function printOut()
{
   //if($this->count)
   //{
       $i = 1;
       $html = '<strong>Count executed queries : </strong>'. $this->count;
       $html .= '<br/>';
       $html .= '<strong>Currents queries : </strong>';
       foreach($this->queries as $query)
       {
           $html .= '<div>'. $i.'--- '. $query . '</div>';
           $i++;
       }

       echo $html;
       // $html .= implode('<br/>', $this->queries);
       // echo $html;
   //}
   
}

}