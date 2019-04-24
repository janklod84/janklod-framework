<?php 
namespace JK;


/**
 * Application
 * @package JK\Application
*/ 
final class Application 
{

         
            /**
             * Instance of Application
             * @var JK\Application
            */
            private static $instance;



            /**
             * Container Dependency Injection
             * @var JK\Container\ContainerInterface
            */
            private $app;



            /**
              * prevent instance from being cloned
            */
            private function __clone(){}

   

            /**
             * prevent instance from being unserialized
            */
            private function __wakeup(){}

            

            /**
              * Break Point of Application
              * @return mixed
            */
            public function run()
            {   
                echo 'Application::run <br>';
            }



            /**
             * Get one times instance of Application
             * Using pattern Singleton
             * @param  string $root
             * @return JK\Application [ instance of application ]
           */
            public static function instance($root = null): self
            {
                  if(is_null(self::$instance))
                  {
                      self::$instance = new self($root);
                  }

                  return self::$instance;
           }

           



}