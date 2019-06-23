<?php 
namespace JK\Library\HTML\Forms;


use \Exception;


/**
 * class Form
 * 
 * @package JK\Library\HTML\Forms\Form
*/ 
class Form 
{



/**
* @var  array   $data
* @var  string  $output
* @var  string  $surround
* @var  bool    $closed
*/
public static $data = [];
public static $surround = '';
public static $closed = false;



/**
 * Dispay errors
 * 
 * @param array $errors 
 * @param array $ul [ attributes ul ]
 * @return string
*/
public static function displayErrors($errors=[], $ul=[])
{
    if(!empty($errors))
    {
       $html = '<ul%s>'. PHP_EOL;
       $items = array_map(function($error){
          return sprintf('<li>%s</li>', $error).PHP_EOL;
       }, $errors);
     
       $html .= implode($items);
       $html .= '</ul>'. PHP_EOL;
       return sprintf($html, self::attributes($ul));
    }
}


/**
 * Open form
 * 
 * @param  string $action 
 * @param  string $method 
 * @param  array $options 
 * @return void
 */
public static function open($action='', $method='', $options = [])
{
     return sprintf('<form action="%s" method="%s"%s>', 
        $action,  
        $method,
        self::attributes($options)
     ).PHP_EOL;
}


/**
 * Input General
 * 
 * @param array  $attributes
 * @param string $type 
 * @param string $label 
 * @return void
*/
public static function input($attributes = [], $type='text', $label='')
{
     return sprintf(
        '%s<input type="%s"%s>', 
        self::label($label, $attributes),
        $type, 
        self::attributes($attributes)
     ). PHP_EOL;
}



/**
* Input Password
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public static function password($attributes = [], $label='')
{
     return self::input($attributes, 'password', $label);
}


/**
* Input Hidden
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public static function hidden($attributes = [], $label='')
{
     return self::input($attributes, 'hidden', $label);
}

/**
 * CSRF Input
 * 
 * @param null $value 
 * @param string $name 
 * @param string $id 
 * @return void
 */
public static function csrfInput($value=null, $name='csrf_token', $id='csrf_token')
{
    $attributes = compact('name', 'id', 'value');
    return self::hidden($attributes);
}

/**
* Input File
* 
* @param array $attributes 
* @return void
*/
public static function file($attributes = [], $label = '')
{
    return self::input($attributes, 'file', $label);
}


/**
 * Textarea
 * 
 * @param array $attributes 
 * @param string $label 
 * @param string $value 
 * @return void
*/
public static function textarea($attributes = [], $label = '', $value = '')
{
      return sprintf(
       '%s<textarea %s>%s</textarea>', 
       self::label($label, $attributes),
       self::attributes($attributes),   
       $value
      ).PHP_EOL;
}


/**
 * Select
 * 
 * @param array $attributes 
 * @return void
*/
public static function select($attributes = [])
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
public static function inputSubmit($attributes = [])
{
    return self::input($attributes, 'submit', null);
}


/**
* Generate input field type button
* 
* @param array $attributes 
* @param string $value 
* @return void
*/
public static function button($attributes = [], $value = '')
{
      return sprintf(
       '<button%s>%s</button>', 
       self::attributes($attributes),  
       $value 
      ). PHP_EOL;
}


/**
* TO FIX!!!
* Generate field type checkbox 
* 
* @param array $attributes 
* @param string $label 
* @return void
*/
public static function checkBox($attributes = [], $label = '', $checked = 'on')
{
     ($checked == 'on') ? $attributes['checked'] = 'checked' : '';
     return self::input($attributes, 'checkbox', null);
}



/**
 * Close builing inputs
 * 
 * @return string
*/
public static function close()
{
   return '</form>'.PHP_EOL;
}




/**
* Surround field
* NO FINISH!
* 
* @param string $data 
* @return string
*/
public static function surround($data, $attributes = [])
{
     if(self::surround)
     {
         $attr = self::attributes($attributes);
         $html = sprintf("<{self::surround} %s>", $attr). PHP_EOL;
         $html .= $data;
         $html .= "</{self::surround}>". PHP_EOL;

     }else{

         return $data;
     }
}


/**
 * Strigify attributes
 * 
 * @param array $attributes 
 * @return string
*/
public static function attributes($attributes=[])
{
   if($attributes)
   {
       $str = '';
       foreach($attributes as $key => $value)
       {
            $str .= sprintf(' %s="%s"', $key, $value);
       }
       return $str;
   }
}


/**
 * Get Label
 * 
 * @param string $content 
 * @param string $attributes
 * @return string
*/
public static function label($content, $attributes)
{
    $output = '';
    $id = $attributes['id'] ?? null;
    if($content)
    {
        $output .= sprintf(
        '<label for="%s">%s</label>',   
        $id, 
        $content
        ).PHP_EOL;
    }
    return $output;
}


/**
 * Style inline
 * 
 * @param array $attributes 
 * @return string
*/
public static function styliser($attributes=[])
{
      $style = '';
      foreach($attributes as $property => $value)
      {
          $style .= sprintf('%s:%s;', $property, $value);
      }
      return sprintf('style="%s"', $style);
}


}