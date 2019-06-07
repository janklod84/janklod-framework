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
|   Check compatibility php version user with that used application
|----------------------------------------------------------------------
*/

if(!version_compare(PHP_VERSION, '7.1', '>='))
{
   exit(
     'This application use <b> version php >= 7.1 </b>.
      But your version php is <b> '. PHP_VERSION . '</b>'
  );
}


/*
|-------------------------------------------------------------------
|    Application starting time
|-------------------------------------------------------------------
*/

define('JKSTART', microtime(true));



/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once realpath(__DIR__ .'/../vendor/autoload.php');



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

require_once realpath(__DIR__.'/../bootstrap/app.php');


/*
|-------------------------------------------------------
|    Run Application
|-------------------------------------------------------
*/

$app->run();


