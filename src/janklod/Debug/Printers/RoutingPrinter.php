<?php 
namespace JK\Debug\Printers;

/**
 * @package JK\Debug\Printers\RoutingPrinter 
*/ 
class RoutingPrinter extends CustomPrinter
{
      
      
  /**
   * Get output
   * @return string
  */
  public function output()
  {
    $html  = '<div style="'. $this->getStyle() . '">';
    $html .= '<table class="table table-striped">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th scope="col">Current Controller</th>';
    $html .= '<th scope="col">Current View</th>';
    $html .= '<th scope="col">Current Layout</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<th scope="row">'; 
    $html .= '<code>'. $this->app->get('current.controller') . '</code>'; 
    $html .= '</th>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->app->get('current.view.path') .'</code>'; 
    $html .= '</td>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->app->get('current.layout.path') .'</code>'; 
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    return $html;
  }


  /**
   * Get style
   * @return string
  */
   protected function getStyle()
   {
      $style  = 'position:fixed;';
      $style .= 'z-index:9999;';
      $style .= 'bottom:0;';
      $style .= 'left:0;';
      $style .= 'right:0;';
      $style .= 'ligne-height:30px;';
      return $style;
   }
}