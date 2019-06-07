<?php 
/*
|----------------------------------------------------------------------
|   Application  :  Framework using pattern MVC
|   Name         :  Janklod
|   Author       :  Jean-Claude [Жан-Клод] <jeanyao34@yahoo.com>
|----------------------------------------------------------------------
*/

/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once realpath(__DIR__ .'/../vendor/autoload.php');


/*
|-------------------------------------------------------------------
|    Application starting time
|-------------------------------------------------------------------
*/

define('JKSTART', microtime(true));


/*
|-------------------------------------------------------
|    Development mode 
|    FALSE mean that you are in production mode
|    TRUE  mean that you are in develpment mode
|-------------------------------------------------------
*/

define('DEV', true);


/*
|----------------------------------------------------------------------
|    Error Handler settings
|----------------------------------------------------------------------
*/

error_reporting(E_ALL);
set_error_handler('JK\Exception\ErrorHandler::errorHandler');
set_exception_handler('JK\Exception\ErrorHandler::exceptionHandler');



/*
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

$app = require_once realpath(__DIR__.'/../bootstrap/app.php');



/*
|-------------------------------------------------------
|    Run Application
|-------------------------------------------------------
*/

$app->run();