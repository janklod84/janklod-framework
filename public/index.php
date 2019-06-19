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
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

$app = require_once realpath(__DIR__.'/../bootstrap/app.php');



/*
|-------------------------------------------------------
|    Check instance of Kernel
|-------------------------------------------------------
*/
$kernel = $app->get(JK\Foundation\Http\Kernel::class);



/*
|-------------------------------------------------------
|    Get Response
|-------------------------------------------------------
*/

$response = $kernel->handle(
  $request = \JK\Http\Request::capture()
);


/*
|-------------------------------------------------------
|    Send all headers to navigator
|-------------------------------------------------------
*/

$response->send();


/*
|-------------------------------------------------------
|    Terminate
|-------------------------------------------------------
*/

$kernel->terminate($request, $response);