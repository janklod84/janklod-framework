<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE
/*
$options = [
	'prefix' => [
	  'path' => '/admin',
	  'controller' => 'admin'
	]
];

Route::group($options, function () {
    Route::get('/', 'HomeController@index', 'welcome.page');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::post('/contact', 'HomeController@contact');
});


Route::get('/me', [
   'controller' => 'HomeController',
   'action' => 'me', 
   'fromArray' => 'Jean-Claude'
])
->with(['id'=> '([0-9+])'])
->with('slug', '([a-z-_A-Z])');


Route::get('/test', function () {
    echo 'Привет друзья!';
}, 'test.page');


*/


$options = [
  'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($options, function () {
    Route::get('/', 'HomeController@index', 'welcome.page');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::post('/contact', 'HomeController@contact');
});


Route::get('/me', [
   'controller' => 'HomeController',
   'action' => 'me', 
   'fromArray' => 'Jean-Claude'
])->with(['id'=> '([0-9+])'])->with('slug', '([a-z-_A-Z])');


Route::get('/test', function () {
    echo 'Привет друзья!';
}, 'test.page');
