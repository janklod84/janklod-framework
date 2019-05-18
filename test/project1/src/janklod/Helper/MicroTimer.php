<?php 
namespace JK\Helper;


use JK\FileSystem\File;


/**
 * This class map result time of loading current page
 * It's used in development
 * @package JK\Helper\MicroTimer
*/ 
class MicroTimer 
{
            
 
	        /**
	         * Initial time when started page
	         * @var int
	        */
	        private $start;

            
            /**
             * @var array $messages
            */
            private $messages = [];


            /**
             * Style template
             * @var string
            */
	        private $style;


        
            /**
             * @const array 
            */
            const DATA_STYLE = [
               'position'     => 'fixed',
               'bottom'       =>  0,
               'background'   => '#900', // #007BFF
               'color'        => '#fff',
               'line-height'  => '30px',
               'height'       => '30px',
               'left'         => 0,
               'right'        => 0,
               'padding-left' => '10px',
               'z-index'      => 9999,
               'font-family'  => 'Arial'
            ];



	        /**
	         * Constructor
	         * @param float $start
             * @param string $translate
	         * @return string
	        */
		    public function __construct($start)
		    {
                 $this->start = $start;
                 $this->file  =  new File(ROOT);
		    }

	        
            /**
             * Add message
             * @param string $code 
             * @param string $message 
             * @return void
            */
            public function addMessage($code, $message = null)
            {
                   $this->messages[$code] = $message;
            }


	        /**
	         * Microtimer
	         * @param string $code [ code language we want to show messages ]
             * @param int $times 
	         * @return string
	        */
		    public function show($code = 'en', $times = 5)
		    {
                 if($showMsg = $this->getMessage($code))
                 {
                     $html  = PHP_EOL;
                     $html .= sprintf('<div style="%s">%s</div>', 
                                    $this->styleStringify(), 
                                    sprintf($showMsg, $this->rounder($times))
                                 );
                     $html .= PHP_EOL;
                     echo $html;
                 }
		    }


		    /**
             * Get style
             * @return string
            */
            private function styleStringify()
            {
            	 $style = '';
            	 foreach (self::DATA_STYLE as $property => $value)
            	 {
            	 	 $style .= sprintf('%s:%s;', $property, $value);
            	 }
            	 return $style;
            }

            
            /**
             * Round value
             * @param int $times [How many times]
             * @return string
            */
            private function rounder($times)
            {
                return round(microtime(true) - $this->start, $times);
            }

            
            /**
             * Get message
             * @param string $code 
             * @return mixed
            */
            private function getMessage($code)
            {
                 $path = 'app/lang/'. mb_strtolower($code) .'/microtimer.php';

                 if($this->file->exists($path))
                 {
                     $message = $this->file->call($path);

                     if(isset($message['msg']))
                     {
                         return $message['msg'];
                     }
					 
                 }elseif(isset($this->messages[$code])){

					 return $message[$code];

				 }else{

					 return false;
				 }
            }


}