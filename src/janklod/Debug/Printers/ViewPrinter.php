<?php 
namespace JK\Debug\Printers;

/**
 * @package JK\Debug\Printers\ViewPrinter 
*/ 
class ViewPrinter extends CustomPrinter
{
      
      
  /**
   * Get output
   * @return string
  */
  public function output()
  {
    $html  = '<table class="table table-striped">';
    $html .= '<thead>';
    $html .= '<tr><th>Views</th></tr>';
    $html .= '<tr>';
    $html .= '<th scope="col">Current View</th>';
    $html .= '<th scope="col">Current Layout</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->app->get('current.view.path') .'</code>'; 
    $html .= '</td>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->app->get('current.layout.path') .'</code>'; 
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    return $html;
  }
}