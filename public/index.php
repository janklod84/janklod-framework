<?php 

/*
|----------------------------------------------------------------------
|   Application  :  Framework using pattern MVC
|   Name         :  Janklod
|   Author       :  Jean-Claude [Жан-Клод] <jeanyao34@yahoo.com>
|----------------------------------------------------------------------
*/



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


/*
|-------------------------------------------------------
|    Show microtimer development
|    it's show how many times page generated
|    in production set DEV to false 
|    constante DEV inside file bootstrap/app.php
|-------------------------------------------------------
*/

$app->microtimer(\Config::get('app.microtime'));