<?php 
namespace JK\Http;


/**
 *  $response = new Response('Привет мир', 301, ['Content: xxx', '...', '...']);
 * 
 *  (new Response())->withHeaders(['Content: xxx', '...', '...'])
 *                  ->withStatus(500)
 *                  ->withBody('Жан-Клод')
 *                  ->send();
 *
 * @package JK\Http\Response 
*/ 
class Response implements ResponseInterface
{
       
/**
 * @var string
*/
private $content;


/**
 * @var int
*/
private $status;


/**
 * @var array
*/
private $headers = [];


/**
 * Register all stored params
 * @var array
*/
private static $stored = [];


/**
 * Response constructor
 * @param string $content 
 * @param string|int $status 
 * @param null|array $headers 
 * @return void
*/
public function __construct(
string $content = '', 
int $status = 200, 
array $headers = []
)
{
  $this->content  = $content;
  $this->status   = $status;
  $this->headers  = $headers;
}


 /**
 * set status
 * @param int $status 
 * @return void
*/
public function setStatus(int $status = 200)
{
 $this->status = $status;
}

/**
 * set content
 * @param string $content 
 * @return void
*/
public function setBody(string $content = '')
{
     $this->content = $content;
}


/**
 * set header
 * Exemple:
 * 
 * $this->setHeader('Location: /admin');
 * $this->setHeader('Location', 'site');
 * $this->setHeader([
 *   'Location1' => 'admin1',
 *   'Location2' => 'admin2',
 *  ]);
 * 
 * @param string|array $header 
 * @param mixed value
 * @return void
*/
public function setHeader($header = null, $value=null)
{
    if($header && !is_null($value))
    {
         $header .= ': '. $value;
    }
    array_push($this->headers, $header);
}


/**
 * Return response with setted status
 * @param int $status 
 * @return void
*/
public function withStatus($status = null)
{
 $this->setStatus($status);
 return $this;
}

/**
 * Return response with setted content
 * @param string $content 
 * @return void
*/
public function withBody(string $content = null)
{
  $this->setBody($content);
  return $this;
}


/**
 * Return response with setted header
 * Exemple:
 * $this->withHeader('Location: /to/dd')
 * $this->withHeader(['Content: HtttpX1', 'Content: HtttpX2', 'Content: HtttpX3']);
 * $this->withHeader('Location: /admin');
 * $this->withHeader('Location', 'site');
 * $this->withHeader([
 *   'Location1' => 'admin1',
 *   'Location2' => 'admin2',
 *  ]);
 * @param string $header 
 * @param string $value
 * @return void
*/
public function withHeader($header = null, $value=null)
{
  $this->setHeader($header, $value);
  return $this;
}


/**
 * Return status
 * @return int
*/
public function getStatus()
{
    return $this->status;
}


/**
 * Return content
 * @return int
*/
public function getBody()
{
   return $this->content;
}


/**
 * Return all setted headers
 * @return array
*/
public function getHeaders()
{
   return $this->headers;
}


/**
 * Redirect to setted path
 * If headers not sent we'll sent header location
 * @param string $to 
 * @return void
*/
public static function redirect($to='/')
{
    if(!headers_sent())
    {
        $redirect = sprintf('Location: %s', $to);
        self::$stored['redirects'][] = $redirect;
        header($redirect);
        exit;
    }
}


/**
 * Set http header status code
 * @param int $code 
 * @return void
*/
public function setCode(int $code)
{
    self::$stored['codes'][] = $code;
    http_response_code($code);
}



/**
 * Json encoding data [JsonFy]
 * @param array $content 
 * @return void
*/
public function asJson($content=[])
{
    self::$stored['json'][] = $content;
    return json_encode($content);
}



/**
 * Send all setted headers and show content
 * Protocol with status , 
 * header('HTTP/1.1 '. $this->status) or
 * http_response_code($this->status)
 * 
 * Show status code
 * @return void
*/
public function send()
{
    if(!headers_sent())
    {
        $this->setCode($this->status);
        $this->sendHeaders();
        $this->sendBody();
    }
}


/**
 * Send all setted headers to server
 * @return void
*/
public function sendHeaders()
{
    if(!empty($this->headers))
    {
        foreach($this->headers as $header)
        {
             if(is_array($header))
             {
                foreach($header as $k => $v)
                {
                    $parsed = sprintf('%s: %s', $k, $v);
                    header($parsed);
                    self::$stored['headers'][] = $parsed;
                }
             }else{
                 header($header);
                 self::$stored['headers'][] = $header;
             }  
        }
    }
}


/**
 * Send body to server
 * @return void
*/
public function sendBody()
{
    echo $this->content;
    self::$stored['content'][] = $this->content;
}


/**
 * Stored
 * @return array
*/
public function stored()
{
    return self::$stored;
}

}