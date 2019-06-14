<?php 

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


define('ROOT', realpath(__DIR__.'/../'));

/*
|-------------------------------------------------------------------
|    Create new application
|    Root directory specifly  dirname(__DIR__) or [../]
|-------------------------------------------------------------------
*/

$app = \JK\Foundation\Application::instance(ROOT);



/*
|-------------------------------------------------------------------
|    Binds importantes interfaces
|-------------------------------------------------------------------
*/


$app->singleton('console', function () use($app) {
   return $app->make(JK\Foundation\Shell::class);
});

$app->singleton('request', function () use($app) {
   return $app->make(JK\Http\Request::class);
});


/*
|-------------------------------------------------------------------
|    Return instance of application 
|    [ Because may be we'll need application somewhere]
|-------------------------------------------------------------------
*/

return $app;

