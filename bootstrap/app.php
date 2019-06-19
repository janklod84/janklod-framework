<?php 

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
|    Definition root directory of Application  
|-------------------------------------------------------------------
*/

define('ROOT', realpath(__DIR__.'/../'));



/*
|-------------------------------------------------------------------
|    Create new application
|-------------------------------------------------------------------
*/

$app = \JK\Foundation\Application::instance();


/*
|-------------------------------------------------------------------
|    Binds importantes interfaces as Singleton
|-------------------------------------------------------------------
*/
$app->singleton('file', function () use ($app) {
   return $app->make(JK\FileSystem\File::class, [ROOT]);
});

$app->singleton(JK\Foundation\Http\Kernel::class, function () use ($app) {
	return $app->make(JK\Foundation\Http\Kernel::class);
});

$app->singleton(JK\Foundation\Console\Kernel::class, function () use ($app) {
	return $app->make(JK\Foundation\Console\Kernel::class);
});


/*
|-------------------------------------------------------------------
|    Return instance of application 
|    [ Because may be we'll need application somewhere]
|-------------------------------------------------------------------
*/

return $app;

