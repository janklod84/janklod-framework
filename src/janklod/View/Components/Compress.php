<?php 
namespace JK\View\Components;


/**
 * @package JK\View\Components\Compress
*/
class Compress 
{
      
private static $search =  [
      "/(\n)+/",
      "/\r\n+/",
      "/\n(\t)+/",
      "/\n(\ )+/",
      "/\>(\n)+</",
      "/\>\r\n</",
];

private static $replace = [
      "\n",
      "\n",
      "\n",
      "\n",
      '><',
      '><',
];

/**
 * Compress Page 
 * For exemple it used for HTML body
 * 
 * @param string $page
 * @return string
*/
public static function page(string $page = null)
{
    return preg_replace(self::$search, self::$replace, $page);
}
}