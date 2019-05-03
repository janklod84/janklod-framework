<?php 
namespace JK\Template;


use \Url;
use \Config;

/**
 * @package JK\Template\Asset 
*/
class Asset 
{

	 
       const FORMAT_TYPE = [
         'js'  => '<script src="%s.js" type="text/javascript"></script>'. PHP_EOL,
         'css' => '<link rel="stylesheet" href="%s.css">'. PHP_EOL
       ];

       
       /**
        * @var array $css
        * @var array $js
       */
       private static $css = [];
       private static $js = [];
     


       /**
        * Add css
        * @var string $link
        * @return void
       */
       public static function css($link = '')
       {
            self::$css[] = trim($link, '/');
       }

       /**
        * Add css
        * @var string $script
        * @return void
       */
       public static function js($script = '')
       {
           self::$js[] = trim($script, '/');
       }
      

       /**
        * Render all css
        * @return string
       */
       public static function renderCss()
       {
       	   echo self::render(self::$css, 'css');
       }

       
       /**
        * Render all js
        * @return string
       */
       public static function renderJs()
       {
       	   echo self::render(self::$js, 'js');
       }


       /**
        * Render all type format
        * @param string $type 
        * @return string
       */
       private static function render($data = [], $type)
       {
       	   $config = Config::get('asset.'. $type) ?? [];
           $data = array_merge($data, $config);

           if(!empty($data))
           {
           	   $asset = '';
           	   foreach ($data as $path)
               {
                  $asset .= sprintf(self::FORMAT_TYPE[$type], Url::base() . '/'.  trim($path, '/'));
               }
               return $asset;
           }
       }
}