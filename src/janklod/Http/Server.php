<?php 
namespace JK\Http;


/**
 * @package JK\Http\Server 
*/ 
class Server
{
	   
	    /**
	     * @var \JK\Http\HttpGlobals
	    */
	    private $serverCollection;



	    /**
	     * Constructor
	     * @return void
	    */
	    public function __construct()
	    {
             $this->serverCollection = GlobalCollection::find('server');
	    }


	   /**
	     * Get Protocol server
	     * @return type
	    */
	    public function protocol()
	    {
	         return $this->get('SERVER_PROTOCOL');
	    }

        
        /**
         * Return port used by server
         * @return string
        */
        public function port()
        {
             return $this->get('SERVER_PORT'); 
        }


        /**
         * Return document root of server
         * @return string
        */
        public function root()
        {
             return $this->get('DOCUMENT_ROOT'); 
        }
      

        /**
          * Get Server SCHEME
          * @return string
        */
        public function scheme()
        {
              return $this->get('REQUEST_SCHEME');
        }


        /**
         * Get arguments in mode cli
         * @return ?array
        */
        public function cli($type = 'argv')
        {
            return $this->get($type);
        }


        /**
         * Get request Uri
         * @return string
        */
        public function uri()
        {
            return $this->get('REQUEST_URI');
        }


        /**
         * Return query string
         * @param bool $trim 
         * @return string
        */
        public function queryString($trim = false)
        {
            $qs = $this->get('QUERY_STRING');

            if($trim === true) 
            { 
                return rtrim($qs, '/');

            }else{ 

                return $qs;
            }
        }

        
        /**
         * Determine get ajax request [ xhr ]
         * @return mixed
        */
        public function xmlHttpRequest()
        {
            return $this->get('HTTP_X_REQUESTED_WITH');
        }


        /**
         * Return request method
         * @return string
        */
        public function method()
        {
            return $this->get('REQUEST_METHOD');
        }


        /**
         * Get User ip
         * Get the direct ip for user [1]
         * Get if user uses proxy     [2]
         * Get the direct ip for user [1]
         * @return string
        */
        public function ip()
        {
        	 $ip = $this->get('REMOTE_ADDR'); // [1]

        	 if($this->get('HTTP_CLIENT_IP')) // [2]
        	 {
        	 	    $ip = $this->get('HTTP_CLIENT_IP');

        	 }elseif($this->get('HTTP_X_FORWARDED_FOR')){

        	 	    $ip = $this->get('HTTP_X_FORWARDED_FOR');
        	 }

        	 return $ip;
        }


        /**
         * Return server host
         * @return string
        */
        public function host(): string
        {
             return $this->get('HTTP_HOST');
        }

        
        /**
         * Return secure protocol
         * @return string
        */
        public function https()
        {
            return $this->get('HTTPS');
        }

        

       /**
        * Get item from $_SERVER
        * @param string $key 
        * @return mixed
       */
	   public function get($key = null)
	   {
	   	   if(is_null($key))
	   	   {
	   	   	   return $this->serverCollection->all();
	   	   }
	   	   return $this->has($key) ? $this->serverCollection->get($key) : null;
	   }

       
       /**
        * Determine if isset item in $_SERVER
        * @param string $key 
        * @return bool
       */
	   public function has($key): bool
	   {
	   	    return $this->serverCollection->has($key);
	   }
}