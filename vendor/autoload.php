<?php 


/*
 | 'AUTOLOAD_DIR' : Directory file to autoload 
 | __DIR__.'/../'
 | dirname(__DIR__)
*/

define('AUTOLOAD_DIR', realpath(__DIR__.'/../'));
require(AUTOLOAD_DIR.'/src/Autoloader.php');
\JK\Autoloader::instance(AUTOLOAD_DIR)->register();

