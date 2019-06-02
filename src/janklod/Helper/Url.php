<?php

class Url 
{

        const DEFAULT_URI = '#';
		
		
		public static function to($uri = null, $params = [])
		{

		     // $url = ($uri) ? $uri : '#'; 

			 $url = ($uri) ? $uri : DEFAULT_URI; 
		     
		     if(!empty($params))
		     {
		          $url .= '?'. self::buildQueryString($params);
		     }

		     return $url;
		}

        public static function a($uri = null, $item = 'item', $params = [])
        {
            return '<a href="'. self::to($uri, $params) . '">'. $item . '</a>'.PHP_EOL;
        }
		
		
		private static function buildQueryString($params)
		{
		    $queryString = '';
		    
		    foreach($params as $param => $value)
		    {
		        $queryString .= "$param=$value&amp;";
		    }

		    return rtrim($queryString, '&amp;');
		}
		
}


Url::to('/admin/test');
Url::a('admin/about', 'About');
