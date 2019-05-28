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
    Route::get('/about/:slug-:id', 'HomeController@about');
    Route::get('/contact/:id', 'HomeController@contact', 'contact.me')->with('id','[0-9+]');
    Route::post('/contact', 'HomeController@contact');
});

echo base_url() . '/'. url('contact.me', ['id' => 1]);

Route::get('/', function () {
    echo 'Salut les amis! <br>';
});

Route::get('/test', function () {
    echo 'Juste un test! <br>';
});

// Route::get('/', 'HomeController@index', 'welcome.page');

Route::get('/about/:id', [
   'controller' => 'HomeController',
   'action' => 'about'
])->with('id','[0-9+]');


Route::get('/test/:slug-:id', function () {
    echo 'Привет друзья!';
}, 'test.page')->with('slug', '[a-z\-0-9]+')->with(['id' => '[0-9+]']);
