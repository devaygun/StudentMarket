<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'ApiAuthController@login');
Route::post('register', 'ApiAuthController@register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'ApiAuthController@logout');

    /* Items */
        Route::get('/items', 'ItemController@index');
        Route::get('/items/{category}/{id}', 'ItemController@readItem');

    /* User */
        Route::get('/view/{id}', 'UserController@viewUser');
        Route::post('/view/{id}/reviews', 'UserController@createReview');
        Route::get('/profile', 'UserController@index'); // Retrieves the profile based on the api_token
        Route::post('/profile', 'UserController@update')->name('update_profile');

    /* Messages */
        Route::get('/messages', 'MessageController@index');
        Route::get('/messages/{id}', 'MessageController@viewMessages');
        Route::post('/messages/{id}', 'MessageController@sendMessage');
});
