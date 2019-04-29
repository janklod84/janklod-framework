<?php 


/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/


/*
OK
Route::get('', function () {
  echo 'Welcome';
});


Route::get('/about', function () {
  echo 'About';
});

Route::get('/:slug-:id', 'HomeController@index', 'welcome.page')
->with(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);

Route::get('/about/:slug-:id', 'HomeController@about')
->with(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);

*/


/*
Route::get('/', 'HomeController@index', 'welcome.page');
Route::get('/about', 'HomeController@about');
Route::get('/about/:id', 'HomeController@about')->with('id', '[0-9]+');
Route::get('/contact', 'HomeController@contact', 'contact.show');


Route::post('/contact', 'HomeController@submit');

Route::get('/test', [
 'controller' => 'TestController',
 'action'     => 'index'
]);


echo '<h2>Group</h2>';

*/


$options = [
 'prefix' => [
 	'path' => '/admin', 
 	'controller' => 'admin'
 ],
];

Route::group($options, function () {

   Route::package('', 'UserController');

});

