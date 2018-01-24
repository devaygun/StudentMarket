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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group([
//
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::get('me', 'AuthController@me');
//
//});

Route::post('login', 'AuthController@tokenFromCredentials');

//Route::post('register', 'AuthController@register');
//Route::post('login', 'AuthController@login');
//Route::post('recover', 'AuthController@recover');
//Route::group(['middleware' => ['jwt.auth']], function() {
//    Route::get('logout', 'AuthController@logout');
//    Route::get('test', function(){
//        return response()->json(['foo'=>'bar']);
//    });
//});