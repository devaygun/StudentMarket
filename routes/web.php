<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/* Item Routes */
/* ..Create */
Route::post('/items/add', 'ItemController@createItem');
/* ..Read */
Route::get('/items', 'ItemController@index');
Route::get('/items/{category}/{id}', 'ItemController@readItem');
Route::get('/items/my', 'ItemController@myItems');
/* ..Edit */
Route::get('/items/update/{id}', 'ItemController@editItem');
Route::post('/items/update/{id}', 'ItemController@updateItem');
/* ..Delete */
Route::post('/item/{id}/remove', 'ItemController@removeItem');


Route::post('/images/remove', 'ImageController@delete');



/* Search Routes */
Route::get('/search/{string}', 'SearchController@index');


/* User Routes */
Route::get('/view/{id}', 'UserController@viewUser');
Route::get('/view/{id}/reviews', 'UserController@getReviews');
Route::post('/view/{id}/reviews', 'UserController@createReview');
Route::get('/profile', 'UserController@index');
Route::post('/profile', 'UserController@update')->name('update_profile');