<?php 
namespace JK\Template\Components;


use \Config;

/**
 * @package JK\Template\Components\Asset 
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
private static $css  = [];
private static $js   = [];
private static $basePath = '';



/**
 * Manager or Map assets
 * @param array $css 
 * @param array $js 
 * @param string $basePath 
 * @return void
*/
public static function map($css=[], $js=[], $basePath='')
{
    self::basePath($basePath);
    self::pushCss($css);
    self::pushJs($js);
}



/**
 * Add base path [base_url(), Url::base()]
 * It's base URL
 * Ex: Asset::basePath('http://site.loc') ..
 * 
 * @param string $basePath  NEW METHOD
 * @return void
*/
public static function basePath($basePath='')
{
     self::$basePath = $basePath;
}


/**
 * Add full paths js
 * Ex: Asset::pushJs([
 * '/assets/script',
 * '/jquery/jquery-3.3.3.min',
 * '/bootstrap/bootstrap.min',
 *  .........
 * 
 * ])
 * 
 * @param array $js
 * @return void
*/
public static function pushJs($js=[])
{
    self::$js = array_merge($js, self::$js);
}


/**
 * Add full paths css
 * Ex: Asset::pushCss([
 * '/assets/style',
 * '/css/app',
 * '/bootstrap/bootstrap.min',
 *  .........
 * 
 * ])
 * 
 * @param array $css 
 * @return void
*/
public static function pushCss($css=[])
{
    self::$css = array_merge($css, self::$css);
}



/**
* Add css
* extension [.css]  will be added automatically
* Ex: Asset::css('/assets/style')
* 
* @var string $link
* @return void
*/
public static function css($link = '')
{
    self::$css[] = trim($link, '/');
}


/**
* Add js
* extension [.js] will be added automatically
* Ex: Asset::js('/assets/script')
* 
* @var string $script
* @return void
*/
public static function js($script = '')
{
   self::$js[] = trim($script, '/');
}



/**
* Get style
* echo Asset::strCss([
*   'padding' => 30px, 
*   'margin-bottom' => '20px'
* ])
* style="padding:30px;margin:20px;"
* 
* @param array $styles
* @return string
*/
public static function strCss(array $styles)
{
    $style = '';
    foreach ($styles as $property => $value)
    {
       $style .= sprintf('%s:%s;', $property, $value);
    }
    return sprintf('style="%s"', $style);
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
* Render all type format OLD
* @param string $type 
* @return string
*/
private static function renderType($data = [], $type)
{
   if(!empty($data))
   {
   	   $asset = '';
   	   foreach($data as $path)
       {
          $asset .= sprintf(
              self::FORMAT_TYPE[$type], self::mapPath($path, self::$basePath)
              );
       }
       return $asset;
   }
}


/**
 * Map Path
 * @param string $path 
 * @return string
*/
private static function mapPath($suject, $path='')
{
    $location = '/'. trim($suject, '/');
    if($path)
    {
        $location = trim($path, '/') . $location;
    }
    return $location;

}


}