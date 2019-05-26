<?php 

/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once realpath(__DIR__ .'/../vendor/autoload.php');



/*
|----------------------------------------------------------------------
|   Check compatibility php version user with that used application
|----------------------------------------------------------------------
*/

if(version_compare(PHP_VERSION, '7.1', '<='))
{
   exit(
     'You must to check version php >= 7.1, 
     because This application use version more than 7.1!'
  );
}



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
|    Start session
|-------------------------------------------------------------------
*/
\JK\Http\Sessions\Session::start();



/*
|-------------------------------------------------------------------
|    Initialize all Functions of Application
|-------------------------------------------------------------------
*/
\JK\Initialize::functions();




/*
|-------------------------------------------------------------------
|    Get instance of Application 
|-------------------------------------------------------------------
*/

$app = \JK\Application::instance(ROOT);



/*
|-------------------------------------------------------------------
|   Loading all alias
|-------------------------------------------------------------------
*/

$app->loadAlias();




/*
|-------------------------------------------------------------------
|   Loading all providers
|-------------------------------------------------------------------
*/

$app->loadProviders();




/*
|-------------------------------------------------------------------
|   Loading all routes of Application
|-------------------------------------------------------------------
*/

$app->file->call('routes/app.php');


/*
|-------------------------------------------------------------------
|   Add all collections routes
|-------------------------------------------------------------------
*/

$app->router->addRoute(
	\JK\Routing\Registers\RouteCollection::all()
);

