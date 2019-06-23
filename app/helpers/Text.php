<?php 
namespace app\helpers;


/**
 * @package app\helpers\Text 
*/ 
class Text 
{
   
 
/**
 * Minify length of text
 * 
 * @param  string $content 
 * @param  int    $limit 
 * @return string
*/
public static function excerpt(string $content, int $limit = 60)
{
     if(mb_strlen($content) <= $limit)
     {
          return $content;
     }
     
     $lastSpace = mb_strpos($content, ' ', $limit);
     return mb_substr($content, 0, $lastSpace).'...';
}
}