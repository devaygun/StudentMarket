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

Route::get('/items', 'ItemController@index');
Route::get('/items/{category}/{id}', 'ItemController@readItem');
Route::post('/items/{category}/{id}', 'ItemController@updateItem');


Route::get('/{category}/items', 'ItemController@index'); // Change formatting of items? studentmarket.dev/items/{category or 'all'}
Route::get('/{category}/item/{id}', 'ItemController@readItem'); // studentmarket.dev/items/{category}/{id}
Route::post('/{category}/item/{id}', 'ItemController@updateItem'); // studentmarket.dev/items/{category}/{id}


/* Profile Routes */

Route::get('/profile', 'UserController@index');
Route::post('/profile', 'UserController@update')->name('update_profile');
