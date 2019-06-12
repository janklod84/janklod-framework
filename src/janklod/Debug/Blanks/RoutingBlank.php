<?php 
namespace JK\Debug\Blanks;

/**
 * @package JK\Debug\Blanks\RoutingBlank 
*/ 
class RoutingBlank extends CustomBlank
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
      $html .= '<th>Routing</th>';
      $html .= '<th scope="col">Path</th>';
      $html .= '<th scope="col">Route Name</th>';
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
      $html .= '<code>';
      $html .=  $this->app->get('current.route')['path'];
      $html .= '</code>'; 
      $html .= '</th>';
      $html .= '<th scope="row">'; 
      $html .= '<code>';
      $html .=  $this->app->get('current.route')['name'];
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
      $html .= '<code>'. $this->app->get('current.action'). '</code>'; 
      $html .= '</th>';
      $html .= '</tr>';
      $html .= '</tbody>';
      $html .= '</table>';
      return $html;
   }
}

}