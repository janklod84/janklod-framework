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
    $html  = '<table class="table table-striped">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Routing</th>';
    $html .= '<th scope="col">Path</th>';
    $html .= '<th scope="col">Route Name</th>';
    $html .= '<th scope="col">Route Prefix</th>';
    $html .= '<th scope="col">Request Method</th>';
    $html .= '<th scope="col">Controller</th>';
    $html .= '<th scope="col">Action</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<th scope="row">'; 
    $html .= '#';
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $html .= '<code>/';
    $html .=  $this->app->get('current.route')['path'];
    $html .= '</code>'; 
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $html .= '<code>';
    $html .=  $this->app->get('current.route')['name'];
    $html .= '</code>'; 
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $prefix = $this->app->get('current.route')['prefix'];
    $html .= '<code>';
    $html .=  !empty($prefix) ? 'Prefixes: '. implode(',', $prefix) : 'no prefixed';
    $html .= '</code>'; 
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $html .= '<code>';
    $html .=  $this->app->get('current.route')['method'];
    $html .= '</code>'; 
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $html .= '<code>'. $this->app->get('current.controller') . '</code>'; 
    $html .= '</th>';
    $html .= '<th scope="row">'; 
    $html .= '<code>'. $this->app->get('current.route')['action'] ?: '' . '</code>'; 
    $html .= '</th>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    return $html;
  }
}