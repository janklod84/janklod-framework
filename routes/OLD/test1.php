<?php 


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