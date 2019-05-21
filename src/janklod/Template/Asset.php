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
        * Add js
        * @var string $script
        * @return void
       */
       public static function js($script = '')
       {
           self::$js[] = trim($script, '/');
       }

       
       

       /**
        * Render factory
        * @var string $type
        * @return string
       */
       public static function render(string $type = '')
       {
       	   if(!array_key_exists($type, self::FORMAT_TYPE))
           {
                exit(sprintf('This type [<strong>%s</strong>] has not render!', $type));
           }
           echo self::renderType(self::${$type}, $type);
       }


       /**
        * Render all type format
        * @param string $type 
        * @return string
       */
       private static function renderType($data = [], $type)
       {
       	   $config = Config::get('asset.'. $type) ?? [];
           $data = array_merge($config, $data);
           if(!empty($data))
           {
           	   $asset = '';
           	   foreach($data as $path)
               {
                  $asset .= sprintf(self::FORMAT_TYPE[$type], 
                                    Url::base() . '/'.  trim($path, '/')
                            );
               }
               return $asset;
           }
       }
}