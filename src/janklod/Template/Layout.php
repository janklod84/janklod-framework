<?php 
namespace JK\Template;



/**
 * @package JK\Template\Layout
*/
class Layout
{

  /**
   * @var string $head
   * @var string $body
   * @var string $foot
  */
  private $head;
  private $body;
  private $foot;



 const TYPE_PART = ['head', 'body', 'foot'];



/**
 * Used in the layouts to embed the head and body
 * @method content
 * @param string $type can be head or body
 * @return string returns the output buffer of head and body
*/
public function content($type)
{
     if(!in_array($type, self::TYPE_PART))
     {
         return false;
     }
     return $this->{$type};

}


/**
 * start the output buffer for the head or body
 * @param string 
 * @return void
*/
public function start($type)
{
	   $this->output = $type;
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
         if($this->output == $type)
         {
             $this->{$type} = ob_get_clean();
         }
    }
}

}