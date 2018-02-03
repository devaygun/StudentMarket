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

    Route::get('/items', 'ItemController@index');
    Route::get('/items/{category}/{id}', 'ItemController@readItem');
});
