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
             * @var JanKlod\Application
            */
            private static $instance;



            /**
             * Container Dependency Injection
             * @var JanKlod\Container\ContainerInterface
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
             * @param  string $root
             * @return JanKlod\Foundation\Application
           */
            public static function instance(string $root = null): self
            {
                  if(is_null(self::$instance))
                  {
                      self::$instance = new self($root);
                  }

                  return self::$instance;
           }



}