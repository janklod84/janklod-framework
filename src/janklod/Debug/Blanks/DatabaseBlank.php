<?php 
namespace JK\Debug\Blanks;

/**
 * @package JK\Debug\Blanks\DatabaseBlank 
*/ 
class DatabaseBlank extends CustomBlank
{


/**
  * Get output
  * @return string
*/
public function output()
{
     if($queries =  $this->app->get('current.queries'))
     {
         $i = 1;
         $html = '<table class="table table-striped">';
         $html .= '<thead>';
         $html .= '<tr>';
         $html .= '<th scope="col">#</th>';
         $html .= '<th scope="col">Executed Queries :</th>';
         $html .= '</tr>';
         $html .= '<tbody>';
         $html .= '<tr>';
         if(!empty($queries)):
         foreach($queries as $query):
         $html .= '<td>'. $i++ .'</td>';
         $html .= '<td>'. $query .'</td>';
         $html .= '</tr>';
         endforeach;
         else:
         $html .= '<td></td>';
         $html .= '<td col="2">No Query Executed!</td>';
         endif;
         $html .= '</tr>';
         $html .= '</tbody>';
         $html .= '</table>';
         $html .= '<strong>Count executed queries : </strong>'. count($queries);
         echo $html;
    }
}


/**
  * Get output
  * @return string
*/
public function outputSecond()
{
    $html  = '<table class="table table-striped">';
    $html .= '<thead>';
    $html .= '<tr><th>Database</th></tr>';
    $html .= '<tr>';
    $html .= '<th scope="col">Current Queries</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<td>'; 
    $html .= '<code>'. '---NO QUERIES---' .'</code>';
    $html .= '</td>'; 
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    return $html;
}

}