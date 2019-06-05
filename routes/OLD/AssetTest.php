<?php 


class AssetTest
{
   
    const MASK_BLANK = [
       'js'  => '<script src="%s.js" type="text/javascript"></script>'. PHP_EOL,
       'css' => '<link rel="stylesheet" href="%s.css">'. PHP_EOL
    ];

    private static $assets = [];
    
    public static function addAssets($assets=[])
    {
        self::$assets = array_merge(self::$assets, $assets);
    }

    public static function css($link='')
    {
        self::$assets['css'][] = $link;
    }

    public static function js($js='')
    {
        self::$assets['js'][] = $js;
    }


    public static function render($type='')
    {
    	self::ensureType($type);
    	$output = '';
        foreach(self::$assets[$type] as $asset)
        {
            $output .= sprintf(self::MASK_BLANK[$type], $_SERVER['HTTP_HOST'] .'/'. $asset);
        }
        echo $output;
    }
    
    /**
     * Make sure has valid type parsed
     * @param string $type 
     * @return void
    */
    private static function ensureType($type)
    {
    	if(!array_key_exists($type, self::MASK_BLANK))
    	{
    		 exit(
    		 	sprintf('Sorry this key <b>%s</b> does not valid!', $type)
    		 );
    	}
    }
}

// CSS
/*
AssetTest::css('app');
AssetTest::css('bootstrap.min');
AssetTest::css('style');
AssetTest::render('css');

// JS
AssetTest::js('app');
AssetTest::js('bootstrap.min');
AssetTest::js('script');
AssetTest::render('js');

*/

echo '<!DOCTYPE html>';
// PUSH Assets
AssetTest::addAssets([
 'css' => [
    'app',
    'bootstrap.min',
    'style'
 ],
 'js' => [
    'app',
    'bootstrap.min',
    'script'
 ]
]);

AssetTest::render('css');
echo '<br>';
AssetTest::render('js');