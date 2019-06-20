<?php 
namespace JK\HTML\Library\Forms;


use \Exception;


/**
 * class Form
 * 
 * @package JK\HTML\Library\Forms\Form
*/ 
class BForm 
{



/**
* @var  array   $data
* @var  string  $output
* @var  string  $surround
* @var  bool    $closed
*/
protected $data = [];
protected $output = PHP_EOL;
protected $surround = '';
protected $closed = false;



/**
 * Construct
 * 
 * @param array $data 
 * @return void
*/
public function __construct($data=[])
{
	  $this->data = $data;
}


/**
 * Open form
 * 
 * @param  string $action 
 * @param  string $method 
 * @param  array $options 
 * @return void
 */
public function open($action='', $method='', $options = [])
{
     ob_start();
     $this->output = Form::open($action, $method, $options);
     $this->output .= PHP_EOL;
}


/**
 * Input General
 * 
 * @param array  $attributes
 * @param string $type 
 * @param string $label 
 * @return void
*/
public function input($attributes = [], $type='text', $label='')
{
     $this->output .= Form::input($attributes, $type, $label);
     $this->output .= PHP_EOL;
}



/**
* Input Password
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public function password($attributes = [], $label='')
{
     $this->output .= Form::input($attributes, 'password', $label);
}


/**
* Input Hidden
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public function hidden($attributes = [], $label='')
{
     $this->output .= Form::input($attributes, 'hidden', $label);
}

/**
 * CSRF Input
 * 
 * @param null $value 
 * @param string $name 
 * @param string $id 
 * @return void
 */
public function csrfInput($value=null, $name='csrf_token', $id='csrf_token')
{
    $attributes = compact('name', 'id', 'value');
    $this->output .=  Form::hidden($attributes);
}

/**
* Input File
* 
* @param array $attributes 
* @return void
*/
public function file($attributes = [], $label = '')
{
    $this->output .= Form::input($attributes, 'file', $label);
}


/**
 * Textarea
 * 
 * @param array $attributes 
 * @param string $label 
 * @param string $value 
 * @return void
*/
public function textarea($attributes = [], $label = '', $value = '')
{
      $this->output .= Form::textarea($attributes, $label, $value);
}


/**
 * Select
 * 
 * @param array $attributes 
 * @return void
*/
public function select($attributes = [])
{
   '<select name="%s">%s</select>'. 
   '<option value="%s">%s</option>';
}


/**
 * Submit Input
 * 
 * @param array $attributes
 * @return void
*/
public function inputSubmit($attributes = [])
{
    $this->output .= Form::input($attributes, 'submit', null);
}


/**
* Generate input field type button
* 
* @param array $attributes 
* @param string $value 
* @return void
*/
public function button($attributes = [], $value = '')
{
      $this->output .= Form::button($attributes, $value);
}


/**
* TO FIX!!!
* Generate field type checkbox 
* 
* @param array $attributes 
* @param string $label 
* @return void
*/
public function checkBox($attributes = [], $label = '', $checked = 'on')
{
     ($checked == 'on') ? $attributes['checked'] = 'checked' : '';
     $this->output .= Form::input($attributes, 'checkbox', null);
}


/**
 * Add content in form
 * 
 * @param array|string $content 
 * @return 
*/
public function html($content=null)
{
     if(is_array($content)) 
     { $this->output .= implode(PHP_EOL, $content); }
     $this->output .= $content . PHP_EOL;
}


/**
 * Close builing inputs
 * 
 * @return string
*/
public function close()
{
   $this->output .= '</form>'.PHP_EOL;
   ob_get_clean(); 
   echo $this->output;
}




/**
* Surround field
* NO FINISH!
* 
* @param string $data 
* @return string
*/
protected function surround($data, $attributes = [])
{
     return Form::surround($data, $attributes);
}


}