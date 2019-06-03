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
 * Set title
 * if no $current [ <title>JK</title> ]
 * if $current is not null [ <title>Article-1 | JK</title> ]
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
 * <title>JK</title>
 * <title>Article-1 | JK</title>
 * @param string $title
 * @return string
*/
public static function title()
{
      echo sprintf('<title>%s</title>', self::$title) . PHP_EOL;
}


/**
 * Set Page Language 
 * @param string $code 
 * @return string
*/
public static function lang($code = 'en')
{
    echo sprintf('<html lang="%s">', $code) . PHP_EOL;
}


/**
 * Encode meta charset
 * @param string $encode 
 * @return string
*/
public static function charset($encode = 'UTF-8')
{
     echo sprintf(self::MASK_META['charset'], $encode) . PHP_EOL;
}


/**
 * Add meta refresh
 * @param int $times 
 * [indicate in seconds how many time you want to refresh content]
 * @param string $url 
 * [indicate concretly domain or path you want to refresh, by default content will ve refresh all them domain]
 * @return string
*/
public static function refresh($times=5, $url='')
{
	 if($times === false) { return; }
	 $content = trim($times, ';');
	 if($url){ $content .= sprintf(';url="%s"', $url); }
	 echo sprintf(
	 	'<meta http-equiv="refresh" content="%s">', $content
	 ). PHP_EOL;
}



}