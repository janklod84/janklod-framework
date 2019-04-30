<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouteHandler
*/ 
class RouteHandler
{
       
        /**
         * @var array  $params   [ Route Params ]
         * @var array  $regex    [ Route regex ]
        */ 
        private $params  = [];
        private $regex   = [];

        
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
             return $this->params ?? [];
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
             # recursive
             if(is_array($parameter) && is_null($regex))
             {
                    foreach($parameter as $index => $exp)
                    {
                         $this->with($index, $exp);
                    }

             }else{
            
                 $this->regex[$parameter] = str_replace('(', '(?:', $regex); 

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
           $this->addPrefix();
           $this->prepareCallback();
      }

        
      /**
       * Do something after storage
       * @return void
      */
      public function afterStore() {}
     

      
      /**
       * Add prefix
       * @return type
      */
      private function addPrefix()
      {
          if(!empty($this->params['prefix']['path']))
          {
              $path = trim($this->params['prefix']['path'], '/') . '/'. $this->get('path');
              $this->set('path', trim($path, '/'));
          }

          if(!empty($this->params['prefix']['controller']))
          {
               $callback = $this->params['prefix']['controller'] . '\\' . $this->get('callback');
               $this->set('callback', $callback);
          }
      }


      /**
        * Prepare callback
        * @return mixed
       */
       private function prepareCallback()
       {
            if(is_string($this->get('callback')))
            {
                if(strpos($this->get('callback'), '@') !== false)
                {
                     list($controller, $action) = explode('@', $this->get('callback'), 2);

                     $callback = [
                       'controller' => $controller,
                       'action'     => $action
                     ];
                }

            }else{

                $callback = $this->get('callback');
            }

            $this->set('callback', $callback);
       }

}