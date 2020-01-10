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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
});

Route::group(['prefix' => 'profile', 'middleware' => 'jwt.verify'], function() {
    Route::get('/', 'UserController@getAuthenticatedUser');
});

Route::group(['prefix' => 'project', 'middleware' => 'jwt.verify'], function(){
    Route::get('/', 'ProjectController@getProject');
    Route::post('/', 'ProjectController@create');
});

Route::group(['prefix' => 'team', 'middleware' => 'jwt.verify'], function(){
    Route::get('/', 'TeamController@getTeam');
    Route::post('/', 'TeamController@create');
});
