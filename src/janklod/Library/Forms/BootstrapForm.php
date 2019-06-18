<?php 
namespace JK\Library\Forms;


/**
 * class BootstrapForm
 * 
 * @package JK\Library\Forms\BootstrapForm
*/ 
class BootstrapForm  extends Form
{

/**
 * @var string $version
*/
protected $version = "4.0";



/**
 * Input
 * 
 * @param array $attributes 
 * @param string $type 
 * @param string $label 
 * @return void
 */
public function input($attributes = [], $type='text', $label='')
{
      $this->output .= '<div class="form-group">'.PHP_EOL;
      $this->output .= parent::input($attributes, $type, $label);
      $this->output .= '</div>'.PHP_EOL;
}
}