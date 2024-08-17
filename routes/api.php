<?php

use Illuminate\Http\Request;

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


// User Generica
// Route::apiResource('users', 'Api\UserController');

Route::get('users', 'Api\UserController@index');

// Probar: http://127.0.0.1:8000/api/followers
Route::get('followers/', 'Api\FollowersController@index');

Route::get('followers/{id}', 'Api\FollowersController@show');
