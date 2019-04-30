<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteHandler
*/ 
class RouteHandler
{
       
        /**
         * @var array  $params [ Route Params ]
         * @var array  $regex  [ Route regex ]
        */ 
        private $params = [];
        private $regex  = [];

        
        /**
         * Constructor
         * @param array $params 
         * @return void
        */
        public function __construct($params = [])
        {
             $this->params = $params;
        }
        

        /**
         * Set params
         * @param string $key 
         * @param mixed $value 
         * @return void
        */
        public function set($key, $value)
        {
              $this->params[$key] = $value;
        }

        /**
         * Determine if isset item
         * @param string $key 
         * @return bool
        */
        public function has($key): bool
        {
            return isset($this->params[$key]);
        }

        
        /**
         * Get item param curren route
         * @param string $key 
         * @return mixed
        */
        public function get($key)
        {
            return $this->has($key) ? $this->params[$key] : null;
        }

        
        /**
         * Get all params curren route
         * @return array
        */
        public function parameters()
        {
            return $this->params;
        }


        /**
         * Determine if parsed url match current route
         * @param string $url 
         * @return bool
        */
        public function match($url)
        {

        }

        
       /**
        * Add regex
        * @param mixed $param 
        * @param mixed $regex 
        * @return $this
       */
       public function with($parameter, $regex = null)
       {
            if(!is_null($regex))
            {
                $this->regex[$parameter] = $regex;
            }

            if(is_array($parameter) && is_null($regex))
            {
                foreach($parameter as $index => $exp)
                {
                     $this->regex[$index] = $exp;
                }
            }
            
            $this->set('regex', $this->regex);
            return $this;
       }

        
      /**
       * Do something before storage
       * @return void
      */
      public function beforeStore()
      {

      }

        
      /**
       * Print out
       * @return void
      */
      public function printOut()
      {
          foreach($this->params as $key => $value)
          {
          }
      }



}