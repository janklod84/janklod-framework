<?php 

require_once '../debug.php';


/*
|----------------------------------------------------------------------
|   Check user php version
|----------------------------------------------------------------------
*/

if(!version_compare(PHP_VERSION, '7.1', '>='))
{
     exit('check version php >= 7.1');
}


/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once realpath(__DIR__ .'/../vendor/autoload.php');



/*
|-------------------------------------------------------------------
|    Route Directory of Application
|    Root directory specifly  dirname(__DIR__) or [../]
|-------------------------------------------------------------------
*/

define('ROOT', '../');


/*
|-------------------------------------------------------
|    Development mode 
|    FALSE mean that you are in production mode
|    TRUE  mean that you are in develpment mode
|-------------------------------------------------------
*/

define('DEV', false);



/*
|-------------------------------------------------------------------
|    Get instance of Application 
|-------------------------------------------------------------------
*/

$app = \JK\Application::instance(ROOT);


