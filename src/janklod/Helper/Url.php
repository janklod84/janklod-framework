<?php 
namespace JK\Helper;


use JK\Http\Request;


/**
 * @package \JK\Helper\Url 
*/
class Url
{
      
    /**
     * Get url from 
     * @param string $uri 
     * @param array $params 
     * @return string
    */
    public static function to($uri = '', $params = []): string
    {
	    if($params)
	    {
	    	$uri .= '?'. http_build_query($params);
	    }
	    return $uri;
    }

    
    /**
     * Return to main page
     * @return string
    */
    public static function back()
    {
    	return header('Location: '. self::base());
    }

    
    /**
     * Base url
     * @return string
    */
    public static function base()
    {
        return (new Request())->baseUrl();
    }
}