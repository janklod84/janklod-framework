<?php 
namespace JK\Debug\Printers;

/**
 * @package JK\Debug\Printers\DatabasePrinter 
*/ 
class DatabasePrinter extends CustomPrinter
{

/**
  * Get output
  * @return string
*/
public function output()
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