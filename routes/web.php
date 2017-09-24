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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', 'HomeController@bookmark')->name('bookmark')->middleware('auth');

Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/bookmarks', 'HomeController@getResponseUrl')->name('bookmark.store');
Route::get('/foo', 'HomeController@foo')->name('bookmark.foo');
Route::get('/bookmark/search/{search}', 'HomeController@search')->name('bookmark.search');
Route::delete('/bookmark/{bookmark}', 'HomeController@destroy')->name('bookmark.destroy');


Route::get('/bookmark/category/{category}', 'CategoryController@index')->name('bookmark.category.index');
Route::post('/bookmark/category', 'CategoryController@store')->name('bookmark.category.store');

Route::get('/twitter', 'HomeController@twitterTest')->name('twitter');
