<?php 
namespace JK\Template\Components;


/**
 * @package JK\Template\Components\HTML
*/ 
class HTML
{

const MASK_META = [
	'content' => '<meta name="%s" content="%s">',
	'charset' => '<meta charset="%s">'
];


/**
 * Title of page
 * @var string 
*/
private static $title;


/**
 * Meta datas
 * @var array
*/
private static $metas = [];



/**
 * set application name
 * @var string
*/
private static $name;



/**
 * Set title
 * @param string $title 
 * @param string $current
 * @return string
*/
public static function setTitle($title, $current = null)
{
      self::$title = $current ? $current .' | '. $title : $title;
}


/**
 * Get title
 * <title>Our Title</title>
 * @return string
*/
public static function title()
{
      return sprintf('<title>%s</title>', self::$title) . PHP_EOL;
}


/**
 * Set Page Language 
 * @param string $code 
 * @return string
*/
public static function lang($code = 'en')
{
    return sprintf('<html lang="%s">', $code) . PHP_EOL;
}


/**
 * Encode meta charset
 * @param type|string $encode 
 * @return type
*/
public static function charset($encode = 'UTF-8')
{
     return sprintf(self::MASK_META['charset'], $encode) . PHP_EOL;
}

}