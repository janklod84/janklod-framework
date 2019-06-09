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


/*
|-------------------------------------------------------------------
|    Create new application
|    Root directory specifly  dirname(__DIR__) or [../]
|-------------------------------------------------------------------
*/

$app = \JK\Foundation\Application::instance(
  realpath(__DIR__.'/../')
);



/*
|-------------------------------------------------------------------
|    Binds importantes interfaces
|-------------------------------------------------------------------
*/

$app->singleton('console', function () use($app) {
   return $app->make(JK\Console\Console::class, [
      $app->file->to('routes/console.php')
   ]);
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

