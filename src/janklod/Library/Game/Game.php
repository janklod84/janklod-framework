<?php 
namespace JK\Library\Game;


/**
 * @package JK\Library\Game\Game 
*/ 
class Game 
{

 const BR = '<br>';

/**
  * @var int      $price
  * @var string   $name
  * @var string   $photo
  * @var string   $dir
  * @var array    $html
 */
 public $price;
 public $name;
 public $photo;
 public $dir  = 'games/';
 public $html = [];
 

/**
* Set Game
* 
* Ex: 
* $game = new Game();
* 
* 
* @param string $name 
* @param string $price 
* @param string $photo 
* @return void
*/
public function set($name, $price, $photo)
{
	  $this->name  = $name;
	  $this->price = $price;
	  $this->photo = $photo;
}


/**
  * Print out game
  * 
  * @return void
 */
 public function output()
 {
     $this->html[] = '<div style="float:left; margin-right: 40px;">';
     $this->html[] = '<font size="5px">%s</font>';
     $this->html[] = '<img src="%s%s">';
     $this->html[] = '$%s';
     $this->html[] = '<button>Add to Cart</button>';
     $this->html[] = '</div>';
     $template = join(self::BR, $this->html);
     $template = sprintf($template, $this->name, $this->dir, $this->photo, $this->price);
     echo $template;
 }

}
