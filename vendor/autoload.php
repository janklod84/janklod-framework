<?php 


/*
 | 'BASE_DIR' : Directory file to autoload 
 | __DIR__.'/../'
 | dirname(__DIR__)
*/

define('BASE_DIR', realpath(__DIR__.'/../'));
@require(BASE_DIR.'/src/Debug.php');
require(BASE_DIR.'/src/Autoloader.php');
\JK\Autoloader::instance(BASE_DIR)->register();

