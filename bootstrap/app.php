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
|    This debug file will be removed later
|    it's for development [ later will be pretty print debogging system ]
|-------------------------------------------------------------------
*/

$app->file->call('src/Debug.php');



/*
|-------------------------------------------------------------------
|    Binds importantes interfaces as Singleton
|-------------------------------------------------------------------
*/

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

