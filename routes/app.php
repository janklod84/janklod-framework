<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE

$options = [
  'path' => '/admin',
  'controller' => 'admin'
];


Route::prefix($options, function () {
    Route::get('/', 'HomeController@index', 'welcome.page');
    Route::get('/about/:slug-:id', 'HomeController@about')
    ->with('slug', '([a-z\-0-9]+)')->with(['id' => '[0-9+]']);
    Route::get('/contact', 'HomeController@contact');
    Route::post('/contact', 'HomeController@contact');
});


Route::get('/about/:test-:id', [
   'controller' => 'HomeController',
   'action' => 'index'
])->with('test', '([a-z\-0-9]+)')->with(['id' => '[0-9+]']);


Route::get('/test/:slug-:id', function () {
    echo 'Привет друзья!';
}, 'test.page')->with('slug', '[a-z\-0-9]+')->with(['id' => '[0-9+]']);
