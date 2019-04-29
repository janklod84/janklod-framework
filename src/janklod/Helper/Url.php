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
		  public static function to(string $uri = '', array $params = []): string
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
		  public function back()
		  {
		  	   return header('Location: /');
		  }
}