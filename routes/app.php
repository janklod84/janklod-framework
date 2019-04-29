<?php 


/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/


Route::get('', function () {

});

echo '<form method="POST" action="" enctype="multipart/form-data">
	<p><input type="text" name="username"></p>
	<p><input type="text" name="password"></p>
  <p><input type="file" name="photo[]" multiple></p>
	<p><button type="submit">Send</button></p>
</form>';


Route::get('/about/page=:id', function ($id) {
    echo $id;
})->with('id', '[0-9]');


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

/*
 |------------------------------------------------------------------
 |                 NOT FOUND ROUTE / PAGE
 |------------------------------------------------------------------
*/

Route::get('/403', 'NotFoundController@page403');
Route::notFound('/403');




$options = [
 'prefix' => [
 	'path' => '/admin', 
 	'controller' => 'admin'
 ],
];

Route::group($options, function () {

   Route::package('', 'UserController');

});


/*
 |------------------------------------------------------------------
 |                 NOT FOUND ROUTE / PAGE
 |------------------------------------------------------------------
*/

Route::get('/404', 'NotFoundController@index');
Route::get('/403', 'NotFoundController@page403');
Route::notFound('/404');

