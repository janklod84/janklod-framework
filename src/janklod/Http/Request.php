<?php 
namespace JK\Http;

use JK\Http\Message\RequestInterface;


/**
 * @package JK\Http\Request 
*/ 
class Request implements RequestInterface
{

       public function __construct(){}
       
       public function method()
       {
       	   return $_SERVER['REQUEST_METHOD'];
       }


       public function uri()
       {
       	   return $_SERVER['REQUEST_URI'];
       }

}