<?php 


/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

/*
Route::get('/', function () {
   echo 'Welcome';
})->with('id', '[0-5]+');

Route::get('/about', function () {
   echo 'About Me';
});


Route::get('/contact', function () {
   echo 'Contact Us';
});


Route::post('/contact', function () {
   echo 'Send mail';
});


Route::get('/test', function () {

   echo 'Test Regex';

})->with('id', '[0-9]+')->with([
 'slug' => '([a-z]+)',
 'test' => '[my-test-ok]'
]);


Route::package('', 'UserController');

*/

/*
Route::get('/', function () {
   echo 'Welcome';
}, 'welcome.page')->with('id', '[0-5]+');
*/

Route::get('', 'HomeController@index', 'welcome.page');

Route::get('about', function () {
   echo 'About me';

});


Route::get('/about/:slug', function ($slug) {
   echo 'About me with parameter '. $slug . '<br>';
}, 'about.me')->with('slug', '[a-z\-]+');

echo '<a href="'. Route::url('about.me', ['slug' => 'your-best-friend']) . '">aboutMe</a>';

$options = [
 'prefix' => [
  'path' => '/admin', 
  'controller' => 'admin'
 ],
];

/*
$options = [
 'prefix' => '/admin'
];
*/

Route::group($options, function () {

  Route::package('', 'UserController');

});


Route::get('/404', 'NotFoundController@index');

