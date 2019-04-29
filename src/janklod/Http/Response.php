<?php 
namespace JK\Http;

use JK\Http\Message\ResponseInterface;


/**
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
         * Response constructor
         * @param string $content 
         * @param string|int $status 
         * @param null|array $headers 
         * @return void
        */
        public function __construct(
            string $content = null, 
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
        public function setStatus($status = null)
        {
             $this->status = $status;
        }

        /**
         * set content
         * @param string $content 
         * @return void
        */
        public function setBody(string $content = null)
        {
             $this->content = $content;
        }


        /**
         * set header
         * @param string $header 
         * @return void
        */
        public function setHeader($header = null)
        {
             $this->headers[] = $header;
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
         * @param string $header 
         * @return void
        */
        public function withHeader($header = null)
        {
             $this->setHeader($header);
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
        public function redirect(string $to = '/')
        {
            if(!headers_sent())
            {
                header(sprintf('Location: %s', $to));
                exit();
            }
        }

        
        /**
         * Set http header code
         * @param int $code 
         * @return void
        */
        public function setCode($code)
        {
            http_response_code($code);
        }


        /**
         * Send all setted headers and show content
         * header('HTTP/1.1 '. $this->status)
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
        private function sendHeaders()
        {
            if(!empty($this->headers))
            {
                foreach($this->headers as $header)
                {
                    header($header); 
                }
            }
        }


        /**
         * Send body to server
         * @return void
        */
        private function sendBody()
        {
            echo $this->content;
        }
}