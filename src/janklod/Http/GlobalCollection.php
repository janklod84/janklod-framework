<?php 
namespace JK\Http;


use JK\Helper\Collection;


/**
 * @package JK\Http\GlobalCollection
*/
class GlobalCollection
{

       /**
        * @var array $data
       */ 
       private static $data = [];


       /**
        * Get data by allowed key
        * @param string $key
        * @return \JK\Helper\Collection
       */
       public static function find($key = null): Collection
       {
       	    switch($key)
            {
                    
                    case 'get':
                      self::$data = $_GET;
                    break;

                    case 'post':
                      self::$data = $_POST;
                    break;

                    
                    case 'request':
                      self::$data = $_REQUEST;
                    break;

                    case 'file':
                      self::$data = $_FILES;
                    break;

                    case 'cookie':
                      self::$data = $_COOKIE;
                    break;

                    case 'server':
                      self::$data = $_SERVER;
                    break;

                    default:
                      throw new \Exception(sprintf('Sorry, key <strong>%s</strong> not match!', $key));
            }

            return new Collection(self::$data);
       }
}