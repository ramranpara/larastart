<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/hello',function (){
    //return view('welcome');
    return '<h1>Hwllo World</h1>';
});
Route::get('/about', function(){
    return view('pages.about');
});
Route::get('/users/{id}', function($id, $name){
    return 'This is user '.$name.' with an id of'.$id;
});
*/
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('invoice', function(){
    return view('invoice');
});

Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?' );
