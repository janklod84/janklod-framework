<?php 
namespace JK\View\Components;


use JK\View\Exceptions\AssetException;

/**
 * @package JK\View\Components\Asset 
*/
class Asset 
{

	 
const MASK_BLANK = [
   'js'  => '<script src="%s.js" type="text/javascript"></script>'. PHP_EOL,
   'css' => '<link rel="stylesheet" href="%s.css">'. PHP_EOL
];


/**
* @var array $assets
* @var string $basePath
*/
private static $assets = [];
private static $basePath = '';



/**
 * Map all assets
 * 
 * @param array $assets
 * @param string $basePath 
 * @return void
*/
public static function map($assets = [], $basePath='')
{
    self::basePath($basePath);
    self::addAssets($assets);
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
 * Add Assets
 * Ex: Asset::addAssets([
 *    'css' => [
 *    'app',
 *   'bootstrap.min',
 *    'style'
 *   ],
 *  'js' => [
 *   'app',
 *    'bootstrap.min',
 *   'script'
 *   ]
 * ]);
 * 
 * @param array $assets
 * @return void
*/
public static function addAssets($assets=[])
{
    self::$assets = array_merge(self::$assets, $assets);
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
    self::$assets['css'][] = trim($link, '/');
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
   self::$assets['js'][] = trim($script, '/');
}



/**
* Get inline style [ Stringify array styles ]
* 
* Ex:
* <div <?= Asset::style([
*   'padding' => 30px, 
*   'margin-bottom' => '20px'
* ]) ?> >Hello</div>
* <div style="padding:30px;margin:20px;">Hello</div>
* 
* @param array $styles
* @return string
*/
public static function style(array $styles)
{
    $style = '';
    foreach($styles as $property => $value)
    {
       $style .= sprintf('%s:%s;', $property, $value);
    }
    return sprintf('style="%s"', $style);
}



/**
* Render all type asset format
* @param string $type 
* @return void
*/
public static function render(string $type='')
{
  if(isset(self::$assets[$type]))
  {
      $output = '';
      foreach(self::$assets[$type] as $path)
      {
         $output .= sprintf(
          self::MASK_BLANK[$type],
          self::mapPath(self::$basePath, $path)
         );
      }
      echo $output;
  }else{
      throw new AssetException(
        sprintf('This type [<strong>%s</strong>] is not setted!', $type), 404
      );
      
  }
}


/**
 * Map Path
 * @param string $basePath 
 * @param string $path 
 * @return string
*/
private static function mapPath($basePath='', $path='')
{
    $location = '/'. trim($path, '/');
    if($basePath)
    {
        $location = trim($basePath, '/') . $location;
    }
    return $location;

}


}