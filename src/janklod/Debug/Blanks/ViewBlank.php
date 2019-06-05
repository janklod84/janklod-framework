<?php 
namespace JK\Debug\Blanks;

/**
 * @package JK\Debug\Blanks\ViewBlank 
*/ 
class ViewBlank extends CustomBlank
{
      
  
  /**
   * Get output
   * @return string
  */
  public function output()
  {
      if(!empty($this->app->get('current.route')))
      {
          $html  = '<table class="table table-striped">';
          $html .= '<thead>';
          $html .= '<tr>';
          $html .= '<th>Views</th>';
          $html .= '<th scope="col">Current View</th>';
          $html .= '<th scope="col">Current Layout</th>';
          $html .= '</tr>';
          $html .= '</thead>';
          $html .= '<tbody>';
          $html .= '<tr>';
          $html .= '<th scope="row">'; 
          $html .= '#';
          $html .= '</th>';
          $html .= '<th scope="row">'; 
          $html .= '<code>'. $this->app->get('current.view.path') .'</code>'; 
          $html .= '</th>';
          $html .= '<th>'; 
          $html .= '<code>'. $this->app->get('current.layout.path') .'</code>'; 
          $html .= '</th>';
          $html .= '</tr>';
          $html .= '</tbody>';
          $html .= '</table>';
          return $html;
     }
  }

  /**
   * Get output
   * @return string
  */
  public function outputOLD()
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