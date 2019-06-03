<?php 
namespace JK\Template;



/**
 * @package JK\Template\Theme
*/
class Theme
{

  /**
   * @var string $head
   * @var string $body
   * @var string $foot
   * @var 
  */
  private $head;
  private $body;
  private $foot;
  private static $output;
  private static $types = []; // 'head', 'body', 'foot'

 const TYPE_PART = ['head', 'body', 'foot'];



/**
 * Used in the layouts to embed the head and body
 * @method content
 * @param string $type can be head or body
 * @return string returns the output buffer of head and body
*/
public static function content($type)
{
     if(!in_array($type, self::TYPE_PART))
     {
         return false;
     }
     return $this->{$type};

}

/**
 * Add type we want to add in buffer
 * @param string $type
 * @return void
*/
public static function addType($type)
{
    array_push(self::$types, $type);
}

/**
 * start the output buffer for the head or body
 * @param string 
 * @return void
*/
public static function start($type)
{
	   self::$output = $type;
	   ob_start();
}


/**
 * Get output
 * @return void
*/
public function end()
{
    foreach(self::TYPE_PART as $type)
    {
         if(self::$output == $type)
         {
             $this->{$type} = ob_get_clean();
         }
    }
}

}