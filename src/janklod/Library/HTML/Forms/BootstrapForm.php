<?php 
namespace JK\Library\HTML\Forms;


/**
 * class BootstrapForm
 * 
 * @package JK\Library\HTML\Forms\BootstrapForm
*/ 
class BootstrapForm  extends Form
{

/**
 * @var string $version
*/
protected static $version = "4.0";



/**
 * Input
 * 
 * @param array $attributes 
 * @param string $type 
 * @param string $label 
 * @return void
 */
public static function input($attributes = [], $type='text', $label='')
{
      $html  = '<div class="form-group">'.PHP_EOL;
      $html .= parent::input($attributes, $type, $label);
      $html .= '</div>'.PHP_EOL;
      return $html;
}
}