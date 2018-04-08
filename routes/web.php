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

Route::get('/', 'PicController@index');

Route::get('/tags', 'TagController@index')->name('tags');
Route::post('/tags', 'TagController@store')->name('tag.store');
Route::get('/tags/{id}/pics', 'TagController@show')->name('tag.show');
Route::get('/tag/{id}/{pic}/detach', 'TagController@detach')->name('tag.detach');
Route::delete('/tag/{id}', 'TagController@destroy')->name('tag.delete');
Route::get('/search','TagController@search')->name('search');

Route::get('/pic/random', 'PicController@randompic')->name('pic.random');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
	'pic' => 'PicController'
]);