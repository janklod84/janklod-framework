<?php 


/*
 | 'AUTO_DIR' : Directory file to autoload 
 | __DIR__.'/../'
 | dirname(__DIR__)
*/


require_once realpath('../src/Autoloader.php');

\JK\Autoloader::instance('../')->register();

