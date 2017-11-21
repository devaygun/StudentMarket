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
/* ..Edit */
Route::get('/item/{id}/update', 'ItemController@editItem');
Route::post('/item/{id}/update', 'ItemController@updateItem');
//Route::post('/items/{category}/{id}', 'ItemController@updateItem');
/* ..Delete */
Route::post('/item/{id}/remove', 'ItemController@removeItem');

/* Profile Routes */

Route::get('/profile', 'UserController@index');
Route::post('/profile', 'UserController@update')->name('update_profile');
