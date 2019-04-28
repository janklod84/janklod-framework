<?php 


/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/


echo '<h2>Basic</h2>';

Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');


/*
Route::get('', function () {
  echo 'Welcome';
});


Route::get('/about', function () {
  echo 'About';
});
*/


/*
Route::get('/', 'HomeController@index', 'welcome.page');

Route::get('/about', 'HomeController@about');
*/
/*
Route::get('/about/:id', 'HomeController@about')
->with('id', '[0-9]+');
*/

/*
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact', 'contact.show');
Route::post('/contact', 'HomeController@submit');


// echo '<h2>Regex</h2>';

Route::get('/:id-:slug', 'HomeController@index', 'welcome.page')
->with('id', '[0-9]+')
->with(['slug' => '[a-z\-0-9]+', 'test' => '[my-regex]+']);


// echo '<h2>Group</h2>';

$options = [
 'prefix' => [
 	'path' => '/admin', 
 	'controller' => 'admin'
 ],
];

Route::group($options, function () {

   Route::package('', 'UserController');

});

*/

