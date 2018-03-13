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

Route::get('/', 'ItemController@index');

/* Items */
    /* Create */
        Route::post('/items/add', 'ItemController@createItem');
    /* Read */
        Route::get('/items', 'ItemController@index');
        Route::get('/items/{category}/{id}', 'ItemController@readItem');
        Route::get('/items/my', 'ItemController@myItems');
    /* Edit */
        Route::get('/items/update/{id}', 'ItemController@editItem');
        Route::post('/items/update/{id}', 'ItemController@updateItem');
    /* Delete */
        Route::post('/item/{id}/remove', 'ItemController@removeItem');
    /* Comments */
        Route::get('/comments/{itemId}', 'CommentController@index');
        Route::post('/comments/{id}', 'CommentController@store');
        Route::post('/comments/{id}/delete', 'CommentController@deleteComment');
    /* Saved Items */
        Route::post('/items/save/{id}', 'ItemController@save');
        Route::get('/items/saved', 'ItemController@savedItems');
    /* Location */
        Route::post('/items/getDistance', 'ItemController@getDistance');


/* Images */
Route::post('/images/remove', 'ImageController@delete');

/* Search */
Route::get('/search', 'SearchController@index');

/* Messages */
Route::get('/messages', 'MessageController@index');
Route::get('/messages/{id}', 'MessageController@viewMessages');
Route::post('/messages/{id}', 'MessageController@sendMessage');

/* User */
Route::get('/view/{id}', 'UserController@viewUser');
Route::post('/view/{id}/reviews', 'UserController@createReview');
Route::get('/profile', 'UserController@index');
Route::post('/profile', 'UserController@update')->name('update_profile');